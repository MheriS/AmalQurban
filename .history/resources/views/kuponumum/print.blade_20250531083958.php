<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Print Kupon</title>
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <style>
        body {
            background: #f0f0f0;
        }
        .ticket {
            width: 600px;
            background: linear-gradient(to right, #81c784, #aed581);
            border-radius: 20px;
            padding: 30px;
            margin: 50px auto;
            color: #000;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .ticket h3 {
            font-weight: bold;
            text-align: center;
        }
        .ticket p {
            font-size: 18px;
            margin-bottom: 10px;
        }
        #qrcode {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="ticket">
    <h3>Kupon Kurban Umum</h3>
    <hr>
    <p><strong>No Kupon:</strong> {{ $kupon->no_kupon }}</p>
    <p><strong>Wilayah:</strong> {{ $kupon->wilayah }}</p>
    <p><strong>Jatah:</strong> {{ $kupon->jatah }} KG</p>
    <p><strong>Jenis Daging:</strong> {{ $kupon->jenis_daging }}</p>
    <p><strong>Status:</strong> {{ $kupon->status }}</p>
    <div id="qrcode"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>
<script>
    new QRCode(document.getElementById("qrcode"), "{{ route('kuponumum.print', $kupon->id) }}");
</script>
<script>
  window.onload = function () {
    window.print();
  };
  window.onafterprint = function () {
  window.close();
};
</script>

</body>
</html>