<?php
require('config.php');
    $res = [];
    $sql = 'select id, nis, nama, alamat from siswa';

    $list_siswa = $conn->query($sql);
    
    if($list_siswa->num_rows > 0){
        while($siswa = $list_siswa->fetch_assoc()){
            // Memasukan Data Siswa kedalam Objek Siswa
            $res_siswa = [
                'nis'=>$siswa['nis'],
                'nama'=>$siswa['nama'],
                'alamat'=>$siswa['alamat']
            ];

            $hasil_nilai = [];

            //Query Mata Pelajaran
            $sql_mapel = 'select id, kode, nama from mapel';

            $list_mapel = $conn->query($sql_mapel);
            //cek jika mata pelajaran datanya lebih dari 0
            if($list_mapel->num_rows > 0){
                
                //mengambil data mata pelajaran
                while($result_mapel = $list_mapel->fetch_assoc()){                    
                    //mengambil nilai id siswa
                    $id_siswa = $siswa['id'];
                    //mengambil nilai id mapel
                    $id_mapel = $result_mapel['id'];

                    $query_nilai = 'select nilai from nilai where siswa_id='.$id_siswa.' AND mapel_id='.$id_mapel;
                    //query database
                    $list_nilai = $conn->query($query_nilai);

                    //cek jika nilai  datanya lebih dari 0
                    if($list_nilai->num_rows > 0){
                        //mengambil data mata pelajaran
                        while($result_nilai = $list_nilai->fetch_assoc()){
                            $nilai_res=[
                                'nama'=>$result_mapel['nama'],
                                'nilai'=>$result_nilai['nilai']
                            ];
                        }
                    }

                    array_push($hasil_nilai, $nilai_res);

                    
                }

                $res_siswa['nilai']=$hasil_nilai;
            }
            // $list_mapel = 
            array_push($res, $res_siswa);
        }
    }

    echo json_encode(["siswa"=>$res]);
?>