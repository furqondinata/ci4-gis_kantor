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
            Edit Data Kantor
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

            echo form_open_multipart('kantor/update/' . $kantor['id']);
            ?>
            <div class="form-group">
                <label>Nama Kantor </label>
                <input name="nama_kantor" value="<?= $kantor['nama_kantor'] ?>" class="form-control" placeholder="Nama Kantor">
            </div>
            <div class="form-group">
                <label>No Telpon</label>
                <input name="no_telpon" value="<?= $kantor['no_telpon'] ?>" class=" form-control" placeholder="No Telpon">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input name="alamat" value="<?= $kantor['alamat'] ?>" class=" form-control" placeholder="Alamat">
            </div>
            <div class="form-group">
                <label>Latitude</label>
                <input name="lat" id=" lat" value="<?= $kantor['lat'] ?>" class=" form-control" placeholder="Latitude">
            </div>
            <div class="form-group">
                <label>Longitude</label>
                <input name="long" id=" long" value="<?= $kantor['long'] ?>" class="form-control" placeholder="Longitude">
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <input name="deskripsi" value="<?= $kantor['deskripsi'] ?>" class=" form-control" placeholder="Deskripsi">
            </div>
            <div class="form-group">
                <img src="<?= base_url('foto/' . $kantor['foto']) ?>" width="100px"><br>
                <label> Ganti Foto</label>
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
        curLocation = [<?= $kantor['lat'] ?>, <?= $kantor['long'] ?>];
    }
    var map = L.map('map').setView([<?= $kantor['lat'] ?>, <?= $kantor['long'] ?>], 14);

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