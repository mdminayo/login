package com.example.danilo.login.Activities.Activities;

import android.app.ProgressDialog;
import android.content.Context;
import android.graphics.Rect;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ListView;
import android.widget.TextView;

import com.example.danilo.login.R;
import com.github.snowdream.android.widget.SmartImageView;
import com.loopj.android.http.AsyncHttpClient;
import com.loopj.android.http.AsyncHttpResponseHandler;

import org.json.JSONArray;
import org.json.JSONException;

import java.util.ArrayList;

import cz.msebera.android.httpclient.Header;

public class Principal extends AppCompatActivity {


    private ListView lista_eventos;
    //nombre,fechainicio, fechafin, poster
    ArrayList nombre= new ArrayList();
    ArrayList fechainicio= new ArrayList();
    ArrayList fechafin= new ArrayList();
    ArrayList poster= new ArrayList();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_principal);
        lista_eventos=(ListView)findViewById(R.id.lista_eventos);
        descargarImagen();

    }

    private void descargarImagen() {
        nombre.clear();
        fechainicio.clear();
        fechafin.clear();
        poster.clear();

        final ProgressDialog progressDialog= new ProgressDialog(Principal.this);
        progressDialog.setMessage("Cargando datos");
        progressDialog.show();

        AsyncHttpClient client= new AsyncHttpClient();
        client.get("http://192.168.0.13/webservices/lista_eventos.php", new AsyncHttpResponseHandler() {
            @Override
            public void onSuccess(int statusCode, Header[] headers, byte[] responseBody) {
                if (statusCode==200){
                    progressDialog.dismiss();

                    try {
                        JSONArray jsonArray= new JSONArray(new String(responseBody));
                        for (int i=0; i<jsonArray.length();i++){
                            nombre.add(jsonArray.getJSONObject(i).getString("nombre"));
                            fechainicio.add(jsonArray.getJSONObject(i).getString("fechainicio"));
                            fechafin.add(jsonArray.getJSONObject(i).getString("fechafin"));
                            poster.add(jsonArray.getJSONObject(i).getString("poster"));
                        }
                       lista_eventos.setAdapter(new ImagenAdapter(getApplicationContext()));

                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }

            }

            @Override
            public void onFailure(int statusCode, Header[] headers, byte[] responseBody, Throwable error) {

            }
        });

    }
    private class ImagenAdapter extends BaseAdapter{
        Context ctx;
        LayoutInflater layoutInflater;
        SmartImageView smartImageView;
        TextView tvnombre, tvfechainicio, tvfechafin;

        public ImagenAdapter(Context applicationContext) {
            this.ctx=applicationContext;
            layoutInflater=(LayoutInflater)ctx.getSystemService(LAYOUT_INFLATER_SERVICE);
        }

        @Override
        public int getCount() {
            return poster.size();
        }

        @Override
        public Object getItem(int position) {
            return position;
        }

        @Override
        public long getItemId(int position) {
            return position;
        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent) {
            ViewGroup viewGroup=(ViewGroup)layoutInflater.inflate(R.layout.activity_principal_item,null);
            smartImageView=(SmartImageView)viewGroup.findViewById(R.id.imagen1);
            tvnombre=(TextView)viewGroup.findViewById(R.id.tvnombre);
            tvfechainicio=(TextView)viewGroup.findViewById(R.id.tvfechainicio);
            tvfechafin=(TextView)viewGroup.findViewById(R.id.tvfechafin);

            String urlfinal="http://192.168.0.13/proyecto/posters/"+poster.get(position).toString();
            Rect rect=new Rect(smartImageView.getLeft(),smartImageView.getTop(),smartImageView.getRight(),smartImageView.getBottom());
            smartImageView.setImageUrl(urlfinal,rect);

            tvnombre.setText(nombre.get(position).toString());
            tvfechainicio.setText(fechainicio.get(position).toString());
            tvfechafin.setText(fechafin.get(position).toString());

            return viewGroup;
        }
    }
}
