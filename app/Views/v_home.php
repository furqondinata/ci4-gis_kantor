<div id="mapid" style="height: 500px;"></div>

<script>
    var mymap = L.map('mapid').setView([-0.9256555598814761, 100.39537658644494], 15);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {

        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',

    }).addTo(mymap);


   
  
    <?php foreach ($kantor as   $key => $value) { ?>
        L.marker([<?= $value['lat'] ?>, <?= $value['long'] ?>]).addTo(mymap)
            .bindPopup("<b><?= $value['nama_kantor'] ?></b><br/>" +
                "<img src='<?= base_url('foto/' . $value['foto']) ?>' width='150px'><br>" +
                "Phone : <br>" +
                "<?= $value['no_telpon'] ?>");
    <?php } ?>
</script>