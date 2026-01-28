<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floating WhatsApp Button</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            min-height: 100vh;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 800px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 40px;
            text-align: center;
            margin-bottom: 30px;
        }

        h1 {
            color: #25D366;
            margin-bottom: 20px;
            font-size: 2.5rem;
        }

        h2 {
            color: #075E54;
            margin: 25px 0 15px;
            font-size: 1.8rem;
        }

        p {
            line-height: 1.6;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin: 30px 0;
        }

        .feature {
            background: white;
            border-radius: 15px;
            padding: 20px;
            width: 45%;
            margin: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .feature:hover {
            transform: translateY(-5px);
        }

        .feature i {
            font-size: 2.5rem;
            color: #25D366;
            margin-bottom: 15px;
        }

        .code-block {
            background-color: #2d2d2d;
            color: #f8f8f2;
            padding: 20px;
            border-radius: 10px;
            text-align: left;
            margin: 20px 0;
            overflow-x: auto;
            font-family: 'Courier New', monospace;
        }

        .instructions {
            text-align: left;
            background: white;
            padding: 25px;
            border-radius: 15px;
            margin: 20px 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .instructions ol {
            margin-left: 20px;
            line-height: 1.8;
        }

        .instructions li {
            margin-bottom: 10px;
        }

        /* Floating WhatsApp Button Styles */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25D366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
            transition: all 0.3s ease;
        }

        .whatsapp-float:hover {
            background-color: #128C7E;
            transform: scale(1.1);
            box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.4);
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
            }
            70% {
                box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }

        /* WhatsApp Tooltip */
        .whatsapp-tooltip {
            position: fixed;
            bottom: 110px;
            right: 40px;
            background-color: #075E54;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 14px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
            z-index: 101;
            white-space: nowrap;
        }

        .whatsapp-float:hover + .whatsapp-tooltip {
            opacity: 1;
            visibility: visible;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .feature {
                width: 100%;
            }

            .whatsapp-float {
                width: 50px;
                height: 50px;
                bottom: 20px;
                right: 20px;
                font-size: 25px;
            }

            .whatsapp-tooltip {
                bottom: 80px;
                right: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fab fa-whatsapp"></i> Floating WhatsApp Button</h1>
        <p>Implementasi tombol WhatsApp mengambang yang dapat diklik untuk mengarahkan pengguna ke halaman WhatsApp dengan pesan yang sudah ditentukan.</p>

        <div class="features">
            <div class="feature">
                <i class="fas fa-mobile-alt"></i>
                <h3>Responsif</h3>
                <p>Tombol akan menyesuaikan ukuran di berbagai perangkat</p>
            </div>
            <div class="feature">
                <i class="fas fa-bell"></i>
                <h3>Efek Animasi</h3>
                <p>Animasi pulsa untuk menarik perhatian pengguna</p>
            </div>
            <div class="feature">
                <i class="fas fa-comment"></i>
                <h3>Pesan Otomatis</h3>
                <p>Pesan default dapat disesuaikan</p>
            </div>
            <div class="feature">
                <i class="fas fa-code"></i>
                <h3>Mudah Diimplementasi</h3>
                <p>Hanya perlu menyalin kode HTML & CSS</p>
            </div>
        </div>

        <h2>Kode Implementasi</h2>
        <div class="code-block">
            <pre>&lt;!-- Floating WhatsApp Button --&gt;
&lt;div class="whatsapp-float"&gt;
    &lt;a href="https://api.whatsapp.com/send?phone=6285262227366text=Halo,%20saya%20tertarik%20dengan%20layanan%20Anda"
       target="_blank"
       style="color: white; text-decoration: none;"&gt;
        &lt;i class="fab fa-whatsapp"&gt;&lt;/i&gt;
    &lt;/a&gt;
&lt;/div&gt;
&lt;div class="whatsapp-tooltip"&gt;Hubungi kami via WhatsApp&lt;/div&gt;

&lt;!-- CSS untuk Floating Button --&gt;
&lt;style&gt;
.whatsapp-float {
    position: fixed;
    width: 60px;
    height: 60px;
    bottom: 40px;
    right: 40px;
    background-color: #25D366;
    color: #FFF;
    border-radius: 50px;
    text-align: center;
    font-size: 30px;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
    z-index: 100;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: pulse 2s infinite;
    transition: all 0.3s ease;
}

.whatsapp-float:hover {
    background-color: #128C7E;
    transform: scale(1.1);
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
    }
    70% {
        box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
    }
}

.whatsapp-tooltip {
    position: fixed;
    bottom: 110px;
    right: 40px;
    background-color: #075E54;
    color: white;
    padding: 10px 15px;
    border-radius: 8px;
    font-size: 14px;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s, visibility 0.3s;
    z-index: 101;
    white-space: nowrap;
}

.whatsapp-float:hover + .whatsapp-tooltip {
    opacity: 1;
    visibility: visible;
}

@media screen and (max-width: 768px) {
    .whatsapp-float {
        width: 50px;
        height: 50px;
        bottom: 20px;
        right: 20px;
        font-size: 25px;
    }

    .whatsapp-tooltip {
        bottom: 80px;
        right: 20px;
    }
}
&lt;/style&gt;</pre>
        </div>

        <div class="instructions">
            <h2>Panduan Implementasi</h2>
            <ol>
                <li>Salin kode HTML untuk tombol WhatsApp dan tempelkan di bagian bawah halaman web Anda (sebelum tag &lt;/body&gt;).</li>
                <li>Ganti nomor telepon "6285262227366" dengan nomor WhatsApp bisnis Anda (format: kode negara + nomor tanpa spasi atau karakter khusus).</li>
                <li>Ubah teks pesan default "Halo,%20saya%20tertarik%20dengan%20layanan%20Anda" sesuai kebutuhan Anda. Gunakan "%20" untuk spasi atau gunakan fungsi JavaScript encodeURIComponent() untuk mengencode pesan.</li>
                <li>Salin kode CSS dan tempelkan di bagian &lt;style&gt; atau file CSS terpisah.</li>
                <li>Sesuaikan ukuran, warna, atau posisi tombol sesuai dengan desain website Anda.</li>
            </ol>
        </div>
    </div>

    <!-- Floating WhatsApp Button -->
    <div class="whatsapp-float">
        <a href="https://api.whatsapp.com/send?phone=6285262227366&text=Halo,%20saya%20tertarik%20dengan%20layanan%20Anda"
           target="_blank"
           style="color: white; text-decoration: none;">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
    <div class="whatsapp-tooltip">Hubungi kami via WhatsApp</div>

    <script>
        // Optional: JavaScript untuk menambahkan fungsionalitas tambahan
        document.addEventListener('DOMContentLoaded', function() {
            const whatsappButton = document.querySelector('.whatsapp-float');

            // Tambahkan efek klik
            whatsappButton.addEventListener('click', function() {
                // Anda bisa menambahkan tracking analytics di sini
                console.log('WhatsApp button clicked');
            });

            // Animasi tambahan saat halaman dimuat
            setTimeout(() => {
                whatsappButton.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    whatsappButton.style.transform = 'scale(1)';
                }, 300);
            }, 1000);
        });
    </script>
</body>
</html>
