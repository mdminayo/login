package com.example.danilo.login.Activities.Activities;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
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

public class MainActivity extends AppCompatActivity {

    EditText txtCor,txtPass;
    Button btnIngresar,btnRegistrar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        txtCor=(EditText) findViewById(R.id.txtCor);
        txtPass=(EditText) findViewById(R.id.txtPass);

        btnIngresar=(Button) findViewById(R.id.btnIngresar);
        btnRegistrar=(Button) findViewById(R.id.btnRegistrar);

        btnIngresar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Thread tr=new Thread(){
                    @Override
                    public void run() {
                        final String res=enviarPost(txtCor.getText().toString(),txtPass.getText().toString());
                        runOnUiThread(new Runnable() {
                            @Override
                            public void run() {
                                int r=objJSON(res);
                                if(r>0){
                                    Intent i=new Intent(getApplicationContext(),Menu_lateral.class);
                                    startActivity(i);
                                }else {
                                    Toast.makeText(getApplicationContext(),"usuario o clave incorrectos",Toast.LENGTH_SHORT).show();
                                }
                            }
                        });
                    }
                };
                tr.start();

            }
        });

        btnRegistrar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i=new Intent(getApplicationContext(),Registrar.class);
                startActivity(i);
            }
        });

    }

    public String enviarPost(String cor,String pass){

        String parametros="email="+cor+"&clave="+pass;
        HttpURLConnection conection=null;
        String respuesta="";

        try{
            URL url=new URL("http://192.168.0.13/webservices/login.php");
            conection=(HttpURLConnection)url.openConnection();
            conection.setRequestMethod("POST");
            conection.setRequestProperty("Content-length",""+Integer.toString(parametros.getBytes().length));

            conection.setDoOutput(true);
            DataOutputStream wr=new DataOutputStream(conection.getOutputStream());
            wr.writeBytes(parametros);
            wr.close();

            Scanner inStream=new Scanner(conection.getInputStream());

            while (inStream.hasNext())
                respuesta+=(inStream.nextLine());
        }catch (Exception e){}

        return respuesta.toString();
   }

   public int objJSON(String rspta){
        int res=0;

        try{
            JSONArray json=new JSONArray(rspta);
            if(json.length()>0)
                res=1;

        }catch (Exception e){}
        return  res;

   }
}
