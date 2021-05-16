<div class="col-sm-7">
    <div class="panel panel-default">
        <div class="panel-heading">
            Lokasi
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="map" style="height: 530px;"></div>
        </div>

    </div>
</div>

<div class="col-sm-5">
    <div class="panel panel-default">
        <div class="panel-heading">
            Data Kantor
        </div>

        <div class="panel-body">
            <?php
            $errors = session()->getFlashdata('errors');
            if (!empty($errors)) { ?>

                <div class="alert alert-danger">
                    !!!!Ada Kesalahan Input Data Yaitu
                    <ul>
                        <?php foreach ($errors as $key => $error) { ?>
                            <li><?= esc($error) ?></li>

                        <?php   } ?>
                    </ul>
                </div>

            <?php } ?>


            <?php

            echo form_open_multipart('kantor/save');
            ?>
            <div class="form-group">
                <label>Nama Kantor </label>
                <input name="nama_kantor" class="form-control" placeholder="Nama Kantor">
            </div>
            <div class="form-group">
                <label>No Telpon</label>
                <input name="no_telpon" class="form-control" placeholder="No Telpon">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input name="alamat" class="form-control" placeholder="Alamat">
            </div>
            <div class="form-group">
                <label>Latitude</label>
                <input name="lat" id="lat" class="form-control" placeholder="Latitude">
            </div>
            <div class="form-group">
                <label>Longitude</label>
                <input name="long" id="long" class="form-control" placeholder="Longitude">
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <input name="deskripsi" class="form-control" placeholder="Deskripsi">
            </div>
            <div class="form-group">
                <label>Foto</label>
                <input type="file" name="foto" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

            <?php echo form_close() ?>
        </div>

    </div>
</div>


<script>
    var curLocation = [0, 0];
    if (curLocation[0] == 0 && curLocation[1] == 0) {
        curLocation = [-0.9256555598814761, 100.39537658644494];
    }
    var map = L.map('map').setView([-0.9256555598814761, 100.39537658644494], 14);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {

        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',

    }).addTo(map);

    map.attributionControl.setPrefix(false);
    var marker = new L.marker(curLocation, {
        draggable: 'true',
    });

    marker.on('dragend', function(event) {
        var position = marker.getLatLng();
        marker.setLatLng(position, {
            draggable: 'true'
        }).bindPopup(position).update();
        $("#lat").val(position.lat);
        $("#long").val(position.lng).keyup();
    });

    $("#lat, #long").change(function() {
        var position = [parseInt($("#lat").val()), parseInt($("#long").val())];
        marker.setLatLng(position, {
            draggable: 'true'
        }).bindPopup(position).update();
        map.panTo(position);
    });

    map.addLayer(marker);
</script>