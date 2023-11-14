<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="<?= base_url('Home'); ?>" class="headerButton goBack">
            <i class="fas fa-arrow-left fa-2x"></i>
        </a>
    </div>
    <div class="pageTitle"><?= $judul; ?></div>
    <div class="right"></div>
</div>
<!-- * App Header -->

<div class="row" style="margin-top : 70px;">
    <div class="col">
        <style>
            .my_camera,
            .my_camera video {
                display: inline-block;
                width: 100% !important;
                margin: auto;
                height: auto !important;
                border-radius: 15px;
            }
        </style>
        <div class="my_camera"></div>
        <button class="btn btn-danger btn-block btn-flat" id="TakeAbsen"><i class="fa fa-camera mr-1"></i> Absen Pulang</button>
        <input type="hidden" name="lokasi" id="lokasi">
        <div id="map" style="width:100%; height: 400px;"></div>
        <audio id="notifikasi_out">
            <source src="<?= base_url('sound/keluar.mp3') ?>" type="audio/mpeg">
        </audio>
    </div>
</div>
<script>
    var notifikasi_out = document.getElementById('notifikasi_out');
    Webcam.set({
        width: 420,
        height: 340,
        image_format: 'jpeg',
        jpeg_quality: 90,
    });

    // Attach camera here
    Webcam.attach('.my_camera');




    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        //jika browser tidak support geolocation maka akan menampilakn
        alert("Geolocation is not supported by this browser.");

    }

    function showPosition(position) {
        var x = document.getElementById("lokasi");
        x.value = position.coords.latitude + "," + position.coords.longitude;

        //menampilkan map dan posisi karyawan
        var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 19);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([position.coords.latitude, position.coords.longitude]).addTo(map)
        //radius kantor
        var circle = L.circle([<?= $kantor['lokasi_kantor']; ?>], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: <?= $kantor['radius']; ?> //radius dalam meter
        }).addTo(map);
        //posisi kantor
        var kantorIcon = L.icon({
            iconUrl: '<?= base_url('/kantor.png'); ?>',

            iconSize: [38, 95], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
            popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
        });

        L.marker([<?= $kantor['lokasi_kantor']; ?>], {
                icon: kantorIcon
            }).addTo(map)
            .bindPopup("<b>kantor mu").openPopup();


        //hitung jarak antara posisi pengguna dengan posisi kantor
        var userlocation = L.latLng(position.coords.latitude, position.coords.longitude);
        var distance = userlocation.distanceTo(circle.getLatLng());
        if (distance > circle.getRadius()) {
            Swal.fire({
                icon: 'error',
                title: 'Peringatan !!',
                text: 'Lokasi Anda Terlalu Jauh Dari Kantor !, Anda Harus Berada Di Dalam Radius Kantor !!! ',
                showConfirmButton: false,
                footer: '<a class="btn btn-success" href="<?= base_url('Home'); ?>">Ok</a>'
            });
            document.getElementsByTagName("button")[0].disabled = true;
        }
    }


    //take absen
    $('#TakeAbsen').click(function(e) {
        Webcam.snap(function(data_uri) {
            image = data_uri;
        });
        notifikasi_out.play();
        var lokasi = $('#lokasi').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('Presensi/insertPresensiOut'); ?>",
            data: {
                image: image,
                lokasi: lokasi,
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil !!',
                    text: 'Terima Kasih, Hati-hati Di Jalan !',
                    showConfirmButton: false,
                    footer: '<a class="btn btn-success" href="<?= base_url('Home'); ?>">Ok</a>'
                })
            }
        });
    });
</script>