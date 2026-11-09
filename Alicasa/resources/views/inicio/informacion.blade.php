@extends('layouts.app')

@section('title', 'Sobre nosotros')

@section('content')
<style>
    .container-about {
        font-family: "Arial", sans-serif;
        width: 80%;
        margin: 30px auto 40px;
        padding: 30px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 10px;
        min-height: 300px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .back-link {
        display: inline-block;
        margin-bottom: 20px;
        color: #00857c;
        text-decoration: none;
        font-weight: 500;
    }
    
    .back-link:hover {
        text-decoration: underline;
    }
    
    .page-title {
        color: #00857c;
        font-size: 2.5rem;
        margin-bottom: 30px;
        text-align: center;
        font-weight: 600;
    }
    
    .about-section {
        margin-bottom: 40px;
    }
    
    .section-title {
        color: #00857c;
        font-size: 1.8rem;
        margin-bottom: 15px;
        font-weight: 500;
    }
    
    .section-content {
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 20px;
        text-align: justify;
    }
    
    .feature-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-top: 30px;
    }
    
    .feature-item {
        flex-basis: 30%;
        min-width: 250px;
        margin-bottom: 30px;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }
    
    .feature-title {
        color: #00857c;
        font-size: 1.3rem;
        margin-bottom: 10px;
        font-weight: 500;
    }
    
    .feature-description {
        text-align: justify;
        line-height: 1.6;
    }
    
    @media (max-width: 992px) {
        .feature-item {
            flex-basis: 45%;
        }
    }
    
    @media (max-width: 768px) {
        .feature-item {
            flex-basis: 100%;
        }
        
        .page-title {
            font-size: 2rem;
        }
        
        .section-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="container-about">
    <a href="{{ route('inicio') }}" class="back-link">← Volver</a>
    
    <div class="page-title">¿Qué es Alicasa?</div>
    
    <div class="about-section">
        <p class="section-content">
            Alicasa es una plataforma web dedicada a facilitar el alquiler de diferentes tipos de alojamiento, desde estancias vacacionales y apartamentos hasta pisos completos y chalets. Nuestro objetivo principal es crear una aplicación fácil e intuitiva que simplifique el proceso tanto para las personas interesadas en alquilar como para los propietarios que desean anunciar sus propiedades.
        </p>
        
        <p class="section-content">
            En Alicasa, entendemos que el proceso de alquiler puede ser complicado y estresante. Por eso, nuestro equipo se ha comprometido a desarrollar una solución que elimine obstáculos y haga que la experiencia sea lo más fluida posible para todas las partes involucradas.
        </p>
    </div>
    
    <div class="about-section">
        <h2 class="section-title">¿Por qué elegir Alicasa?</h2>
        
        <div class="feature-list">
            <div class="feature-item">
                <h3 class="feature-title">Facilidad de uso</h3>
                <p class="feature-description">
                    Nuestra interfaz intuitiva permite navegar, buscar y gestionar alojamientos de manera simple y eficiente, sin complicaciones técnicas.
                </p>
            </div>
            
            <div class="feature-item">
                <h3 class="feature-title">Variedad de opciones</h3>
                <p class="feature-description">
                    Ofrecemos una amplia gama de propiedades que se adaptan a diferentes necesidades y presupuestos, desde apartamentos económicos hasta villas de lujo.
                </p>
            </div>
            
            <div class="feature-item">
                <h3 class="feature-title">Proceso transparente</h3>
                <p class="feature-description">
                    Facilitamos información clara sobre precios, disponibilidad y condiciones de alquiler para que no haya sorpresas durante el proceso.
                </p>
            </div>
            
            <div class="feature-item">
                <h3 class="feature-title">Para propietarios</h3>
                <p class="feature-description">
                    Herramientas eficientes y sencillas para publicar y gestionar sus viviendas y administrar sus reservas de forma sencilla.
                </p>
            </div>
            
            <div class="feature-item">
                <h3 class="feature-title">Para inquilinos</h3>
                <p class="feature-description">
                    Búsqueda avanzada con filtros personalizables, sistema de valoraciones y comentarios, y proceso de reserva simplificado en pocos pasos.
                </p>
            </div>
            
            <div class="feature-item">
                <h3 class="feature-title">Soporte personalizado</h3>
                <p class="feature-description">
                    Nuestro equipo de atención al cliente está disponible para resolver cualquier duda o problema que pueda surgir durante el proceso.
                </p>
            </div>
        </div>
    </div>

</div>
@endsection