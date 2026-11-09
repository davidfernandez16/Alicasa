@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
<style>
    .container-register {
        font-family: "Arial", sans-serif;
        width: 80%;
        margin: 30px auto 20px;
        padding: 30px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 10px;
        min-height: 300px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .page-title {
        text-align: center;
        font-size: 2.2rem;
        margin: 20px 0 40px 0;
        color: #00857c;
        font-weight: 600;
        padding: 0 15px;
    }
    
    .contact-panels {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-between;
    }
    
    .contact-panel {
        flex: 1;
        min-width: 300px;
        padding: 25px;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }
    
    .panel-title {
        font-size: 1.5rem;
        margin-bottom: 15px;
        color: #00857c;
        font-weight: 500;
    }
    
    .panel-content {
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 20px;
        text-align: justify;
    }
    
    .contact-email {
        display: block;
        text-align: center;
        margin: 20px 0;
        font-weight: 600;
        color: #00857c;
        font-size: 1.1rem;
    }
    
    .back-link {
        display: inline-block;
        margin-bottom: 15px;
        color: #00857c;
        text-decoration: none;
        font-weight: 500;
    }
    
    .back-link:hover {
        text-decoration: underline;
    }
    
    @media (max-width: 992px) {
        .contact-panels {
            flex-direction: column;
        }
        
        .page-title {
            font-size: 1.8rem;
        }
    }
</style>

<div class="container-register">
    <a href="{{ route('inicio') }}" class="back-link">← Volver</a>
    
    <div
        class="page-title">¿Alguna pregunta sobre Alicasa?<br>No dudes en contactarnos</h1>
    </div>

    <div class="contact-panels">
        <div class="contact-panel">
            <h2 class="panel-title">Para huéspedes</h2>
            <p class="panel-content">¿Quieres reservar un alojamiento y no sabes cómo? ¿Tienes dudas sobre el proceso de reserva o el pago? Estamos aquí para ayudarte con cualquier consulta relacionada con tu experiencia como huésped.</p>
            <p class="panel-content">Envía un email con el asunto de tu consulta a:</p>
            <a href="mailto:ayudaHuesped@alicasa.com" class="contact-email">ayudaHuesped@alicasa.com</a>
            <p class="panel-content">Te responderemos en un plazo máximo de 24 horas.</p>
        </div>
        
        <div class="contact-panel">
            <h2 class="panel-title">Para anfitriones</h2>
            <p class="panel-content">¿Eres propietario y tienes dudas sobre cómo poner tu vivienda en alquiler? ¿Necesitas información sobre comisiones, requisitos o proceso de publicación? Nuestro equipo especializado está listo para asistirte.</p>
            <p class="panel-content">Envía un email con el asunto de tu consulta a:</p>
            <a href="mailto:ayudaPropietario@alicasa.com" class="contact-email">ayudaPropietario@alicasa.com</a>
            <p class="panel-content">Te responderemos en un plazo máximo de 24 horas.</p>
        </div>
    </div>
</div>
@endsection