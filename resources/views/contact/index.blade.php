@extends('layouts.app')

@section('content')
    <!-- Header -->
    <div class="bg-pmii-blue pt-25 pb-25">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-extrabold uppercase mb-6">Hubungi Kami</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto">
                Kami siap mendengarkan aspirasi, masukan, dan berdiskusi dengan Anda. Kunjungi sekretariat kami atau hubungi melalui kanal digital.
            </p>
        </div>
    </div>

    <!-- Info Cards (Floating Over Header) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-15 relative z-10 pb-3">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            @php
                $alamat = \App\Models\SiteSetting::get('kontak_alamat', 'Jl. Capung No.114, Sidoarjo...');
                $email  = \App\Models\SiteSetting::get('kontak_email', 'pcpmiisda@gmail.com');
                $waListText = \App\Models\SiteSetting::get('kontak_wa_list', '[]');
                $waList = json_decode($waListText, true) ?? [];
                
                // Jika DB masih kosong/bukan array, berikan nilai default 1 nomor (Fallback)
                if (empty($waList)) {
                    $waList = [['nomor' => '6282232619640']];
                }
            @endphp

            <!-- Address Card -->
            <div data-aos="fade-up" class="bg-white rounded-2xl p-8 shadow-xl border-b-4 border-pmii-yellow hover:translate-y-[-5px] transition-transform duration-300">
                <div class="w-14 h-14 bg-blue-50 rounded-full flex items-center justify-center mb-6 text-pmii-blue">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Sekretariat</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    {{ $alamat }}
                </p>
                <a href="https://maps.google.com" target="_blank" class="text-pmii-blue font-semibold hover:text-blue-700 flex items-center">
                    Lihat di Peta <i class="fas fa-arrow-right ml-2 text-sm"></i>
                </a>
            </div>

            <!-- Email Card -->
            <div data-aos="fade-up" data-aos-delay="100" class="bg-white rounded-2xl p-8 shadow-xl border-b-4 border-blue-400 hover:translate-y-[-5px] transition-transform duration-300">
                <div class="w-14 h-14 bg-blue-50 rounded-full flex items-center justify-center mb-6 text-blue-500">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Email Resmi</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Kirimkan surat atau pertanyaan Anda melalui email resmi kami.
                </p>
                <a href="mailto:{{ $email }}" class="text-blue-500 font-semibold hover:text-blue-700 flex items-center" style="word-break: break-all;">
                    {{ $email }}
                </a>
            </div>

            <!-- Phone Card -->
            <div data-aos="fade-up" data-aos-delay="200" class="bg-white rounded-2xl p-8 shadow-xl border-b-4 border-green-400 hover:translate-y-[-5px] transition-transform duration-300">
                <div class="w-14 h-14 bg-blue-50 rounded-full flex items-center justify-center mb-6 text-green-500">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Telepon / WhatsApp</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Hubungi kami untuk respon cepat melalui layanan telepon atau WhatsApp.
                </p>

                <div class="flex flex-col gap-2">
                    @foreach($waList as $wa)
                        @php
                            $rawNum = $wa['nomor'] ?? '';
                            // Format 6282xxx menjadi +62 822-xxxx-xxxx jika memungkinakan
                            $formattedNum = '+'.substr($rawNum, 0, 2).' '.substr($rawNum, 2, 3).'-'.substr($rawNum, 5, 4).'-'.substr($rawNum, 9);
                        @endphp
                        @if($rawNum)
                            <a href="tel:+{{ preg_replace('/[^0-9]/', '', $rawNum) }}" class="text-green-500 font-semibold hover:text-green-700 flex items-center gap-2">
                                <i class="fab fa-whatsapp text-lg"></i> {{ $formattedNum }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <!-- Map Section -->
    <div class="bg-gray-50 py-5">
         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div data-aos="zoom-in" class="bg-white rounded-3xl overflow-hidden shadow-lg p-2">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.1289030758544!2d112.70469337504865!3d-7.450988392560198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e1363b1620e5%3A0x4b74f50b1356aa55!2sJl.%20Capung%20No.114%2C%20Kwadengan%20Barat%2C%20Lemahputro%2C%20Kec.%20Sidoarjo%2C%20Kabupaten%20Sidoarjo%2C%20Jawa%20Timur%2061213!5e0!3m2!1sen!2sid!4v1772545833263!5m2!1sen!2sid" 
                    width="100%" height="450" style="border:0; border-radius: 1rem;" allowfullscreen="" loading="lazy"></iframe>
            </div>
         </div>
    </div>
@endsection
