package com.example.danilo.login.Activities.Activities;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Editable;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.example.danilo.login.R;

import org.json.JSONArray;

import java.io.DataOutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.Scanner;

public class Registrar extends AppCompatActivity {

    EditText txtNombre,txtEmail,txtClave;
    Button btnRegistrar;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_registrar);

        txtNombre=(EditText) findViewById(R.id.txtNombre);
        txtEmail=(EditText) findViewById(R.id.txtEmail);
        txtClave=(EditText) findViewById(R.id.txtClave);

        btnRegistrar=(Button) findViewById(R.id.btnRegistrar);

        btnRegistrar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Thread tr=new Thread(){
                    @Override
                    public void run(){
                        final String res=enviarPost(txtNombre.getText(),txtEmail.getText(),txtClave.getText());
                        runOnUiThread(new Runnable() {
                            @Override
                            public void run() {
                                int r=objJSON(res);
                                if(r>0){
                                    Intent i=new Intent(getApplicationContext(),Principal.class);
                                    startActivity(i);
                                }else {
                                    Toast.makeText(getApplicationContext(),"Registro exitoso",Toast.LENGTH_SHORT).show();
                                }

                            }
                        });


                    }
                };
                tr.start();
            }
        });


    }




   private String enviarPost(Editable text, Editable text1, Editable text2) {
        String parametros="nombre"+text+"&email="+text1+"&clave="+text2;
        HttpURLConnection conection=null;
        String respuesta="";
        try {
            URL url= new URL("http://192.168.0.13/webservices/registro_user.php");
            conection=(HttpURLConnection)url.openConnection();
            conection.setRequestMethod("POST");
            conection.setRequestProperty("Content-length",""+Integer.toString(parametros.getBytes().length));

            conection.setDoOutput(true);
            DataOutputStream wr=new DataOutputStream(conection.getOutputStream());
            wr.writeBytes(parametros);
            wr.close();

            Scanner inStrem = new Scanner(conection.getInputStream());

            while (inStrem.hasNext())respuesta+=(inStrem.nextLine());

        }catch (Exception e){}


        return respuesta.toString();
    }




    private int objJSON(String rspta) {

        int res=0;
        try {
            JSONArray json = new JSONArray(rspta);
            if (json.length()>0) res=1;
        }catch (Exception e){}
        return res;
    }
}
