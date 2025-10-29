@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Get In Touch</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Tertarik berkolaborasi atau memiliki pertanyaan? Mari berhubungan!
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Information -->
            <div>
                <h2 class="text-2xl font-bold mb-6">Contact Information</h2>
                <div class="space-y-6">
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-envelope text-blue-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Email</h4>
                            <p class="text-gray-600">fachrizha08@gmail.com</p>
                        </div>
                    </div>

                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="bg-green-100 p-3 rounded-full mr-4">
                            <i class="fab fa-github text-green-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">GitHub</h4>
                            <p class="text-gray-600"><a href="https://github.com/facchrizhaaripandra">https://github.com/facchrizhaaripandra</a></p>
                        </div>
                    </div>

                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fab fa-linkedin text-blue-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">LinkedIn</h4>
                            <p class="text-gray-600">linkedin.com/in/username</p>
                        </div>
                    </div>

                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="bg-purple-100 p-3 rounded-full mr-4">
                            <i class="fas fa-map-marker-alt text-purple-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Location</h4>
                            <p class="text-gray-600">Indonesia</p>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="mt-8">
                    <h3 class="text-xl font-semibold mb-4">Follow Me</h3>
                    <div class="flex space-x-4">
                        <a href="https://github.com/facchrizhaaripandra" class="bg-gray-800 text-white p-3 rounded-full hover:bg-gray-700 transition duration-300">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="#" class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="bg-blue-400 text-white p-3 rounded-full hover:bg-blue-500 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="bg-red-600 text-white p-3 rounded-full hover:bg-red-700 transition duration-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div>
                <h2 class="text-2xl font-bold mb-6">Send Message</h2>
                <form class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" id="name" name="name"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                               placeholder="Your name">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                               placeholder="your.email@example.com">
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                        <input type="text" id="subject" name="subject"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                               placeholder="Message subject">
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                        <textarea id="message" name="message" rows="5"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                  placeholder="Your message..."></textarea>
                    </div>

                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 flex items-center justify-center">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
