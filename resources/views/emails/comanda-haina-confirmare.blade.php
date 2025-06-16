<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmare comandă - {{ $haina->nume }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }

        .header p {
            margin: 5px 0 0 0;
            opacity: 0.9;
            font-size: 16px;
        }

        .content {
            padding: 30px;
        }

        .success-badge {
            background-color: #d1fae5;
            color: #065f46;
            padding: 12px 20px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 30px;
            border-left: 4px solid #10b981;
        }

        .product-section {
            background-color: #f9fafb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            border: 1px solid #e5e7eb;
        }

        .product-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
        }

        .product-image {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 15px;
            border: 2px solid #10b981;
        }

        .product-info h3 {
            margin: 0;
            color: #111827;
            font-size: 20px;
            font-weight: bold;
        }

        .product-price {
            color: #10b981;
            font-size: 18px;
            font-weight: bold;
            margin: 5px 0;
        }

        .product-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .detail-item {
            background-color: white;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
        }

        .detail-label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .detail-value {
            color: #111827;
            font-weight: 600;
        }

        .info-section {
            background-color: #f3f4f6;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .info-section h4 {
            margin: 0 0 15px 0;
            color: #374151;
            font-size: 16px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .icon {
            margin-right: 8px;
            color: #10b981;
        }

        .info-grid {
            display: grid;
            gap: 10px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #6b7280;
            font-weight: 500;
        }

        .info-value {
            color: #111827;
            font-weight: 600;
        }

        .address-box {
            background-color: white;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
            font-style: italic;
            color: #374151;
        }

        .steps-section {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            border-radius: 12px;
            padding: 20px;
            margin: 30px 0;
        }

        .steps-title {
            text-align: center;
            color: #065f46;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .steps {
            display: grid;
            gap: 15px;
        }

        .step {
            display: flex;
            align-items: center;
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .step-number {
            background-color: #10b981;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .step-content h5 {
            margin: 0 0 5px 0;
            color: #111827;
            font-weight: 600;
        }

        .step-content p {
            margin: 0;
            color: #6b7280;
            font-size: 14px;
        }

        .footer {
            background-color: #111827;
            color: #d1d5db;
            padding: 30px;
            text-align: center;
        }

        .footer h3 {
            color: #10b981;
            margin: 0 0 15px 0;
        }

        .footer p {
            margin: 5px 0;
            font-size: 14px;
        }

        .social-links {
            margin-top: 20px;
        }

        .social-links a {
            color: #10b981;
            text-decoration: none;
            margin: 0 10px;
            font-size: 14px;
        }

        .contact-info {
            background-color: #1f2937;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
        }

        @media (max-width: 600px) {
            .container {
                margin: 0;
                box-shadow: none;
            }

            .content {
                padding: 20px;
            }

            .product-header {
                flex-direction: column;
                text-align: center;
            }

            .product-image {
                margin: 0 0 10px 0;
            }

            .product-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Click Music</h1>
            <p>Confirmarea comenzii tale</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Success Message -->
            <div class="success-badge">
                <strong>✓ Comanda confirmată!</strong> Mulțumim pentru achiziția ta.
            </div>

            <!-- Product Section -->
            <div class="product-section">
                <div class="product-header">
                    <img src="{{ $haina->image_url_full }}" alt="{{ $haina->nume }}" class="product-image">
                    <div class="product-info">
                        <h3>{{ $haina->nume }}</h3>
                        <div class="product-price">{{ number_format($haina->pret, 2) }} RON</div>
                    </div>
                </div>

                <div class="product-details">
                    <div class="detail-item">
                        <div class="detail-label">Categorie</div>
                        <div class="detail-value">{{ ucfirst($haina->categorie) }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Culoare</div>
                        <div class="detail-value">{{ $haina->culoare }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Mărimea</div>
                        <div class="detail-value">{{ $comandaHaina->marime_selectata }}</div>
                    </div>
                </div>
            </div>

            <!-- Order Information -->
            <div class="info-section">
                <h4>
                    <span class="icon">📋</span>
                    Informații comandă
                </h4>
                <div class="info-grid">
                    <div class="info-row">
                        <span class="info-label">Număr comandă:</span>
                        <span class="info-value">{{ $comandaHaina->order_id }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Data comenzii:</span>
                        <span class="info-value">{{ $comandaHaina->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Status:</span>
                        <span class="info-value" style="color: #10b981;">Confirmată</span>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="info-section">
                <h4>
                    <span class="icon">👤</span>
                    Informații client
                </h4>
                <div class="info-grid">
                    <div class="info-row">
                        <span class="info-label">Nume:</span>
                        <span class="info-value">{{ $comandaHaina->nume_cumparator }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email:</span>
                        <span class="info-value">{{ $comandaHaina->email }}</span>
                    </div>
                    @if ($comandaHaina->telefon)
                        <div class="info-row">
                            <span class="info-label">Telefon:</span>
                            <span class="info-value">{{ $comandaHaina->telefon }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Delivery Address -->
            <div class="info-section">
                <h4>
                    <span class="icon">📍</span>
                    Adresa de livrare
                </h4>
                <div class="address-box">
                    {{ $comandaHaina->adresa_livrare }}
                </div>
            </div>

            <!-- Next Steps -->
            <div class="steps-section">
                <div class="steps-title">Ce urmează?</div>
                <div class="steps">
                    <div class="step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h5>Procesare comandă</h5>
                            <p>Comanda ta va fi verificată și pregătită pentru livrare în 1-2 zile lucrătoare.</p>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h5>Pregătire pentru expediere</h5>
                            <p>Produsul va fi ambalat cu grijă și predat curierului pentru livrare.</p>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h5>Livrare</h5>
                            <p>Vei fi contactat telefonic pentru confirmarea livrării la adresa specificată.</p>
                        </div>
                    </div>
                </div>
            </div>

            <p style="text-align: center; color: #6b7280; font-style: italic; margin-top: 30px;">
                Dacă ai întrebări despre comanda ta, nu ezita să ne contactezi!
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <h3>Click Music</h3>
            <p>Mulțumim că ai ales produsele noastre!</p>

            <div class="contact-info">
                <p><strong>Contact:</strong></p>
                <p>Email: contact@clickmusic.ro</p>
                <p>Website: clickmusic.ro</p>
            </div>

            <div class="social-links">
                <a href="https://youtube.com/clickmusicromania">YouTube</a>
                <a href="https://www.facebook.com/clickmusicromania">Facebook</a>
                <a href="https://www.instagram.com/clickmusic1/">Instagram</a>
            </div>

            <p style="margin-top: 20px; font-size: 12px; opacity: 0.7;">
                © {{ date('Y') }} Click Music. Toate drepturile rezervate.
            </p>
        </div>
    </div>
</body>

</html>
