@extends('desa.template')
@section('title')
Peta Desa {{ $desa->nama }}
@endsection

@section('content')

<div class="row">
    <div class="col-md-9">
        <iframe src="http://petadesa.klikdesa.com/mod/peta.php?id={{ $desa->id }}" width="100%" height="600px" frameborder="0" style="border:0" allowfullscreen id="maps"></iframe>

    </div>
    <div class="col-md-3">
        <div style="margin-top: 30px"></div>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#side" class="btn btn-default">Database</a></li>
                <li><a data-toggle="tab" href="#side3" class="btn btn-default">Tataguna Lahan</a></li>
                <li><a data-toggle="tab" href="#side2" class="btn btn-default">Status Lahan</a></li>
            </ul>
                
            <div class="tab-content" style="background:white">
                <div id="side" class="tab-pane fade in active">
                    <ul id='vmenu' class='sidenav' style='overflow: scroll;height: 660px;'></ul> 
                </div>
                <div id="side2" class="tab-pane fade">
                    <ul id='vmenux' class='sidenav'>
                        <li><input type='checkbox' id='status1' name='status1' value='1'/><label for='status1'>Lahan Kas Desa</label></li>
                        <li><input type='checkbox' id='status2' name='status2' value='2'/><label for='status2'>Tanah Negara</label></li>
                        <li><input type='checkbox' id='status3' name='status3' value='3'/><label for='status3'>HGU</label></li>
                        <li><input type='checkbox' id='status4' name='status4' value='4'/><label for='status4'>Perhutani</label></li>
                        <li><input type='checkbox' id='status5' name='status5' value='5'/><label for='status5'>BKSDA</label></li>
                        <li><input type='checkbox' id='status6' name='status6' value='6'/><label for='status6'>Hak Milik</label></li>
                        <li><input type='checkbox' id='status7' name='status7' value='7'/><label for='status7'>Tanah Adat</label></li>
                        <li><input type='checkbox' id='status8' name='status8' value='8'/><label for='status8'>Lahan Potensial</label></li>                      
                    </ul> 
                </div>
                <div id="side3" class="tab-pane fade">
                    <ul id='vmenum' class='sidenav'>
                        <li><input type='checkbox' id='tata1' name='tata1' value='1'/><label for='tata1'>Permukiman</label><span class='ttg' style='clear:both;background-color:#820D1B;border-radius: 50%;width: 20px;height: 20px; padding:8px;border:2px solid #fff;'></span></li>
                        <li><input type='checkbox' id='tata2' name='tata2' value='2'/><label for='tata2'>Sawah</label><span class='ttg' style='clear:both;background-color:#69FF12;border-radius: 50%;width: 20px;height: 20px; padding:8px;border:2px solid #fff;'></span></li>
                        <li><input type='checkbox' id='tata3' name='tata3' value='3'/><label for='tata3'>Pertanian Non Sawah</label><span class='ttg' style='clear:both;background-color:#B5B016;border-radius: 50%;width: 20px;height: 20px; padding:8px;border:2px solid #fff;'></span></li>
                        <li><input type='checkbox' id='tata4' name='tata4' value='4'/><label for='tata4'>Industri</label><span class='ttg' style='clear:both;background-color:#2411F2;border-radius: 50%;width: 20px;height: 20px; padding:8px;border:2px solid #fff;'></span></li>
                        <li><input type='checkbox' id='tata5' name='tata5' value='5'/><label for='tata5'>Fasum Fasos</label><span class='ttg' style='clear:both;background-color:#525137;border-radius: 50%;width: 20px;height: 20px; padding:8px;border:2px solid #fff;'></span></li>
                        <li><input type='checkbox' id='tata6' name='tata6' value='6'/><label for='tata6'>Hutan</label><span class='ttg' style='clear:both;background-color:#7A7709;border-radius: 50%;width: 20px;height: 20px; padding:8px;border:2px solid #fff;'></span></li>
                        <li><input type='checkbox' id='tata7' name='tata7' value='7'/><label for='tata7'>Kebun Campuran</label><span class='ttg' style='clear:both;background-color:#F5F293;border-radius: 50%;width: 20px;height: 20px; padding:8px;border:2px solid #fff;'></span></li>
                        <li><input type='checkbox' id='tata8' name='tata8' value='8'/><label for='tata8'>Perkebunan</label><span class='ttg' style='clear:both;background-color:#858479;border-radius: 50%;width: 20px;height: 20px; padding:8px;border:2px solid #fff;'></span></li>
                        <li><input type='checkbox' id='tata9' name='tata9' value='9'/><label for='tata9'>Pusat Perdagangan</label><span class='ttg' style='clear:both;background-color:#BA4C07;border-radius: 50%;width: 20px;height: 20px; padding:8px;border:2px solid #fff;'></span></li>
                        <li><input type='checkbox' id='tata10' name='tata10' value='10'/><label for='tata10'>Kolam</label><span class='ttg' style='clear:both;background-color:#48CBF0;border-radius: 50%;width: 20px;height: 20px; padding:8px;border:2px solid #fff;'></span></li>                      
                    </ul> 
                </div>
            </div>
    </div>
</div>


@endsection

@section('sidebar_peta')

@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@endsection

@section('scripts')

    <script>

    // var xhr = createCORSRequest('GET', api_url);

    var dataKec = '{{ $desa->id }}';
    var api_url = 'http://peta.itsinergi.id/';


    $.get(api_url + 'mod/filekat.php?desaid=' + dataKec, function (data) {
        console.log(api_url + 'mod/filekat.php?desaid=' + dataKec);
        $("#vmenu").html(data);
    });

    //Database / Kategori
    var searchIDs = [];
    $("#vmenu li input[type=checkbox]").click(function () {
        if ($(this).is(':checked')) {
            $(this).parent().find(':checkbox').prop('checked', true);

            searchIDs.push($(this).val());
            console.log(searchIDs);

            //with iframe
            $("#maps").attr({
                src: api_url + "mod/peta.php?id=" + dataKec + "&jnis=" + searchIDs,
                height: "600px"
            });
            console.log(api_url + "mod/peta.php?id=" + dataKec + "&jnis=" + searchIDs);

            // $.get(api_url+"mod/peta.php?id="+dataKec+"&jnis="+searchIDs, function(data){   
            //      $("#data").html(data);
            //  		      });

        } else {
            $(this).parent().find(':checkbox').prop('checked', false);
            console.log($(this).val());
            console.log(searchIDs.indexOf($(this).val()));
            searchIDs.splice(searchIDs.indexOf($(this).val()), 1);
            $("#maps").attr({
                src: api_url + "mod/peta.php?id=" + dataKec + "&jnis=" + searchIDs,
                height: "600px"
            });

            console.log(api_url + "mod/peta.php?id=" + dataKec + "&jnis=" + searchIDs);

        }
    });

    //Tataguna Lahan
    var searchTata = [];
    $("#vmenum li input[type=checkbox]").click(function () {
        if ($(this).is(':checked')) {
            $(this).parent().find(':checkbox').prop('checked', true);

            searchTata.push($(this).val());
            console.log(searchTata);
            $("#maps").attr({
                src: api_url+'/mod/petatataguna.php?opt4='+ dataKec +'&opt5='+searchTata, 
                height:"600px"
            });
            // $.get("http://localhost/petanasional/mod/petatataguna.php?opt4=" + dataKec + "&jnis=" + searchTata, function (data) {
                // $("#data").html(data);
                // console.log(data);
            // });

        } else {
            $(this).parent().find(':checkbox').prop('checked', false);
            console.log($(this).val());
            console.log(searchTata.indexOf($(this).val()));
            searchTata.splice(searchTata.indexOf($(this).val()), 1);
            $("#maps").attr({
                src: api_url+'mod/petatataguna.php?opt4='+dataKec+'&opt5='+searchTata, 
                height:"600px"
            });

        }
    });

    //Status Lahan
    var searchStatus = [];
    $("#vmenux li input[type=checkbox]").click(function () {
        if ($(this).is(':checked')) {
            $(this).parent().find(':checkbox').prop('checked', true);

            searchStatus.push($(this).val());
            console.log(searchStatus);
            
            // /mod/petastatus.php?id=3205182007&jnis=1


            $("#maps").attr({
                src: api_url+'mod/petastatus.php?id='+dataKec+'&jnis='+searchStatus, 
                height:"600px"
            });

        } else {
            $(this).parent().find(':checkbox').prop('checked', false);
            console.log($(this).val());
            console.log(searchStatus.indexOf($(this).val()));
            searchStatus.splice(searchStatus.indexOf($(this).val()), 1);
            $("#maps").attr({
                src: api_url+'/mod/petastatus.php?id='+ dataKec +'&jnis='+searchStatus, 
                height:"600px"
            });

        }
    });

</script>
@endsection