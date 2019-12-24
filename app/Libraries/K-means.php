<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class K_means {

    //  public function ujicoba(){
    //   $this->load->view('header');
    //   $this->load->view('kmeans/ujicoba');
    //   $this->load->view('footer');
    //  }

    public function hasil()
    {
        $jk=$_POST['jumklas'];
        $table='data_ruspini';
        $col=$this->dmodel->columncount($table)->num_rows();
        //echo $col;
        $colname=$this->dmodel->columname($table);

        //pembangkitan centroid
        for($i=0;$i<$jk;$i++){
            /*for($j=0;$j<$col;$j++){
                $newc[$i][$j]=rand(0,400);
            }*/
            $centroid[$i]=rand(0,100);
        }

        $output['jumklas']=$jk;

        //penghitungan jarak centroid
        /*for($k=0;$k<$jk;$k++){
            $jumcen=0;
            for($j=0;$j<$col;$j++){
                $jumcen=$jumcen+($newc[$k][$j]^2);
            }
        $centroid[$k]=sqrt($jumcen);
        }*/
        $output['centroid']=$centroid;

        //mengambil data colum database
        $co=0;
        foreach($colname as $row){
            $namecol[$co]=$row->name;
            $co++;
        }

        $getdata=$this->dmodel->getdata($table)->result_array();
        $c=0;
        //mengambil nilai data pada database
        foreach($getdata as $row){
            $a=1;
            for($i=0;$i<$co-1;$i++){

                $dat[$c][$i]=$row[$namecol[$a]];
                //echo $dat[$c][$i];
                $a++;
                }
            //echo '';
            $c++;
        }

        //penghitungan jarak pada nilai data
        $k=0;
        $jardat=0;
        for($i=0;$i<$c;$i++){
            for($j=0;$j<$co-1;$j++){
                $jardat=$jardat+($dat[$i][$j]^2);
            }
            $datcen[$i]=sqrt($jardat);

            $k++;
        }

        //penghitungan jarak centroid baru dengan centroid data
        for($i=0;$i<$k;$i++){
            for($j=0;$j<$jk;$j++){
                $jarak=abs($centroid[$j]-$datcen[$i]);
                $datacen[$i][$j]=$jarak;
                $dataklas[$i][$j]=$j;
                $datacen[$i]['centroid']=$datcen[$i];
            }
        }

        //klustering berdasarkan jarak
        for($i=0;$i<$k;$i++){
            for($j=0;$j<$jk;$j++){
                for($l=$j+1;$l<$jk;$l++){
                    if($datacen[$i][$j]>$datacen[$i][$l]){
                        $temp=$datacen[$i][$j];
                        $temp2=$dataklas[$i][$j];
                        $datacen[$i][$j]=$datacen[$i][$l];
                        $dataklas[$i][$j]=$dataklas[$i][$l];
                        $datacen[$i][$l]=$temp;
                        $dataklas[$i][$l]=$temp2;
                    }
                }
            }
            $datakluster[$i]['kluster']=$dataklas[$i][0];
            $datakluster[$i]['jarak']=$datacen[$i][0];
            $datakluster[$i]['centroid']=$datacen[$i]['centroid'];
        }

        /*for($i=0;$i<$k;$i++){
        echo $datakluster[$i]['kluster'].'';
        echo $datakluster[$i]['jarak'].'';
        echo $datakluster[$i]['centroid'].'';


        }*/

        $output['jumlah']=$k;
        $output['datahasil']=$datakluster;

        //   $this->load->view('header');
        //   $this->load->view('kmeans/hasil',$output);
        //   $this->load->view('footer');
    }
}
