@extends('frontend.layout')

@section('content')
<!-- Hero Section -->
<div class="relative">
    <img 
        alt="Background image with a person holding a round object" 
        class="w-full h-96 object-cover" 
        src="https://storage.googleapis.com/a1aa/image/VNiQmUs6Oc64AJZtPuhMu3KC1TKtt25RVbSuA3QV7S3xWp8E.jpg" 
    />
    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <h1 class="text-white text-6xl font-bold">About Us</h1>
    </div>
</div>

<!-- Our Story Section -->
<div class="bg-white py-16 px-8">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <!-- Text Content -->
        <div>
            <h2 class="text-3xl font-bold mb-4 text-gray-900">Cerita Kami</h2>
            <p class="text-gray-700 leading-relaxed">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat consequat enim, non auctor massa ultrices non. Morbi sed odio massa. Quisque at vehicula tellus, sed tincidunt augue. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas varius egestas diam, eu sodales metus scelerisque congue.
            </p>
        </div>
        <!-- Image -->
        <div>
            <img 
                alt="Image of a clothing rack with clothes and a plant" 
                class="w-full h-auto rounded-lg shadow-lg" 
                src="https://storage.googleapis.com/a1aa/image/QiB4lzoXWK4FKNweCQyrK3nNZbEYdZVNaPGRXCdjbo1itS5JA.jpg" 
            />
        </div>
    </div>
</div>

<!-- Our Mission Section -->
<div class="bg-gray-100 py-16 px-8">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <!-- Image with Border Effect -->
        <div class="relative">
            <div class="absolute inset-0 border-4 border-gray-300 transform translate-x-4 translate-y-4"></div>
            <img 
                alt="A person in an orange shirt standing on a rooftop with buildings in the background" 
                class="relative shadow-lg rounded-lg" 
                src="https://storage.googleapis.com/a1aa/image/Suier2rDCb2DHKAtT7D5RzIKlAUt57hxD1IVZUMefWBy6KlnA.jpg" 
            />
        </div>
        <!-- Text Content -->
        <div class="md:pl-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Tujuan Pembuatan</h2>
            <p class="text-gray-700 leading-relaxed">
                Mauris non lacinia magna. Sed nec lobortis dolor. Vestibulum rhoncus dignissim risus, sed consectetur erat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam maximus mauris sit amet odio convallis, in pharetra magna gravida.
            </p>
            <p class="italic text-gray-500 mt-6">
                "Creativity is just connecting things. When you ask creative people how they did something, they feel a little guilty because they didn’t really do it, they just saw something. It seemed obvious to them after a while."
            </p>
            <p class="text-gray-500 mt-2 text-right">– Steve Jobs</p>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="bg-green-500 py-16">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-4xl font-bold text-white mb-4">Mari Bergabung Dengan Kami</h2>
        <p class="text-white text-lg mb-8">
            Discover the story behind our mission and be part of something bigger. Let’s grow together!
        </p>
        <a 
            href="#" 
            class="bg-white text-green-500 font-bold py-3 px-8 rounded-full shadow-lg hover:bg-gray-100 transition duration-300">
            Mulai Jualan
        </a>
    </div>
</div>
@endsection
