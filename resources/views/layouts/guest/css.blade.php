 <link href="{{ asset('assets-guest/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
            rel="stylesheet"
        />
        <link href="{{ asset('assets-guest/css/tiny-slider.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets-guest/css/style.css') }}" rel="stylesheet" />

        {{-- css hal tentang --}}
<style>
    .hero {
        padding: 80px 0;
    }

    .why-choose-section {
        padding: 80px 0;
    }

    .product-section {
        padding: 80px 0;
    }

    .contact-section {
        padding: 80px 0;
        background-color: #f8f9fa;
    }

    .feature {
        padding: 30px 20px;
        text-align: center;
    }

    .feature .icon {
        margin-bottom: 20px;
    }

    .feature .icon i {
        font-size: 2.5rem;
        color: #007bff;
    }

    .feature h3 {
        font-size: 1.25rem;
        color: #2c3e50;
        margin-bottom: 15px;
    }

    .feature p {
        color: #6c757d;
        line-height: 1.6;
    }

    .contact-info {
        padding: 30px 20px;
    }

    .contact-info .icon i {
        color: #6c757d;
    }

    .contact-info h3 {
        font-size: 1.25rem;
        color: #2c3e50;
        margin-bottom: 15px;
    }

    /* GCR Card Styles */
    .gcr-card {
        background: white;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #e9ecef;
        height: 100%;
    }

    .gcr-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .gcr-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .icon-wrapper {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }

    .icon-wrapper i {
        font-size: 1.5rem;
    }

    .profile-img {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        margin-right: 12px;
    }

    .header-text h6 {
        margin: 0;
        color: #2c3e50;
        font-weight: 700;
        font-size: 1.2rem;
    }

    .gcr-footer .date {
        color: #6c757d;
        margin: 0;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    /* Misi List Styles */
    .misi-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .misi-list li {
        display: flex;
        align-items: flex-start;
        color: #6c757d;
        line-height: 1.5;
        font-size: 0.95rem;
    }

    .misi-list li i {
        margin-top: 0.2rem;
        flex-shrink: 0;
    }

    .section-title {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .bg-light {
        background-color: #f8f9fa !important;
    }

    .gcr-card-link {
        text-decoration: none;
        color: inherit;
    }

    .gcr-card-link:hover {
        color: inherit;
        text-decoration: none;
    }
</style>
{{-- footer --}}
 <style>
        /* Pastikan footer di bottom */
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
        }

        .footer-section {
            margin-top: auto;
        }
    </style>

{{-- card --}}
<style>
    /* ===== GLOBAL CARD STYLES ===== */
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            background: #fff;
            margin-bottom: 24px;
            overflow: hidden;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .card-header-custom {
            background: linear-gradient(135deg, #31732e 0%, #81c886 100%);
            color: white;
            padding: 20px 25px;
            border-bottom: none;
        }

        .card-header-custom h5 {
            margin: 0;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .card-body-custom {
            padding: 25px;
        }

    /* ===== CARD GRID LAYOUT ===== */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 24px;
            margin-top: 20px;
        }

        /* ===== CARD CONTENT STYLES ===== */
        .card-item {
            border-left: 4px solid #1f5a0b;
            padding-left: 15px;
            margin-bottom: 15px;
        }

        .card-label {
            font-weight: 600;
            color: rgb(30, 92, 30);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .card-value {
            color: #2d3748;
            font-size: 0.95rem;
            margin: 0;
            line-height: 1.4;
        }

        .card-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
            margin: 20px 0;
        }

    /* ===== ACTION BUTTONS ===== */
        .card-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #f1f5f9;
        }

        .btn-action {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-detail {
            background: #48bb78;
            color: white;
        }

        .btn-detail:hover {
            background: #38a169;
            color: white;
            transform: translateY(-2px);
        }

        .btn-edit {
            background: #ed8936;
            color: white;
        }

        .btn-edit:hover {
            background: #dd771c;
            color: white;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: #f56565;
            color: white;
        }

        .btn-delete:hover {
            background: #e53e3e;
            color: white;
            transform: translateY(-2px);
        }

    /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #718096;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #cbd5e0;
        }

    /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .card-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .card-body-custom {
                padding: 20px;
            }

            .card-actions {
                flex-direction: column;
            }

            .btn-action {
                justify-content: center;
            }
        }

    /* ===== HEADER STYLES ===== */
        .page-header {
            background: linear-gradient(135deg, #126334 0%, #0d751d 100%);
            color: white;
            padding: 40px 0;
            margin-bottom: 40px;
            border-radius: 0 0 20px 20px;
        }

        .section-title {
            color: #2d3748;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .section-subtitle {
            color: #718096;
            margin-bottom: 30px;
        }

    /* ===== ALERT STYLES ===== */
    .alert-custom {
        border: none;
        border-radius: 10px;
        padding: 15px 20px;
        margin-bottom: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
</style>



    <style>
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .card-custom {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            background: white;
        }

        .card-custom:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .card-header-custom {
            padding: 1.25rem 1.25rem 0;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
        }

        .card-header-custom h5 {
            margin: 0;
            flex: 1;
            font-size: 1.1rem;
            color: #2c3e50;
            line-height: 1.4;
        }

        .card-body-custom {
            padding: 1rem 1.25rem 1.25rem;
        }

        .card-item {
            margin-bottom: 0.75rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .card-label {
            font-weight: 600;
            color: #6c757d;
            font-size: 0.875rem;
            min-width: 80px;
        }

        .card-value {
            color: #2c3e50;
            font-size: 0.875rem;
            text-align: right;
            flex: 1;
            margin-left: 1rem;
        }

        .card-divider {
            height: 1px;
            background: #e9ecef;
            margin: 1rem 0;
        }

        .card-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-action {
            padding: 0.375rem 0.75rem;
            border: none;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            transition: all 0.2s;
        }

        .btn-detail {
            background: #e3f2fd;
            color: #1976d2;
        }

        .btn-edit {
            background: #fff3e0;
            color: #f57c00;
        }

        .btn-delete {
            background: #ffebee;
            color: #d32f2f;
        }

        .btn-action:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #dee2e6;
        }

        .empty-state h4 {
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            margin-bottom: 0;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .card-grid {
                grid-template-columns: 1fr;
            }

            .card-header-custom {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .card-actions {
                justify-content: center;
            }

            .btn-action {
                flex: 1;
                justify-content: center;
                min-width: 100px;
            }
        }
    </style>
