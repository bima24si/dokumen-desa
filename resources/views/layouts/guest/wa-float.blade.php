@php
    $whatsappNumber = '6281234567890'; // Ganti dengan nomor WhatsApp Anda
    $defaultMessage = 'Halo saya tertarik dengan layanan Data Warga'; // Pesan default
    $encodedMessage = urlencode($defaultMessage);
    $waUrl = "https://wa.me/{$whatsappNumber}?text={$encodedMessage}";
@endphp

<!-- WhatsApp Float Button -->
<div class="whatsapp-float">
    <a href="{{ $waUrl }}"
       target="_blank"
       class="whatsapp-link"
       title="Hubungi via WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
</div>

<style>
.whatsapp-float {
    position: fixed;
    bottom: 25px;
    right: 25px;
    z-index: 1000;
}

.whatsapp-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    background: #25D366;
    color: white;
    border-radius: 50%;
    text-decoration: none;
    box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
    transition: all 0.3s ease;
    animation: pulse 2s infinite;
}

.whatsapp-link:hover {
    background: #128C7E;
    transform: scale(1.1);
    box-shadow: 0 6px 25px rgba(37, 211, 102, 0.6);
    color: white;
}

.whatsapp-link i {
    font-size: 28px;
}

/* Pulse Animation */
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

/* Responsive Design */
@media (max-width: 768px) {
    .whatsapp-float {
        bottom: 20px;
        right: 20px;
    }

    .whatsapp-link {
        width: 55px;
        height: 55px;
    }

    .whatsapp-link i {
        font-size: 24px;
    }
}
</style>
