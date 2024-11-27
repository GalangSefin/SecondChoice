@extends('frontend.layout')

<div class="bg-white p-4 rounded-lg shadow-md mb-6">
    <!-- Section untuk Zalora -->
    <div class="flex items-center mb-4">
        <div class="flex items-center justify-center w-10 h-10 bg-gray-200 rounded-full mr-4">
            <span class="text-xl font-bold">Z</span>
        </div>
        <div>
            <p class="font-semibold">ZALORA/p>
        </div>
    </div>

    <div class="bg-gray-50 p-4 rounded-lg shadow-inner flex items-center justify-between">
        <div class="flex items-center">
            <input class="mr-4" type="checkbox" />
            <img 
                class="w-20 h-20 object-cover mr-4" 
                src="https://storage.googleapis.com/a1aa/image/oeogpKvqQXwdE6kzu5voI5cb3SffGDmXalChsjbKxmeR0MLPB.jpg" 
                alt="Black high-top sneaker" 
                width="100" 
                height="100" 
            />
            <div>
                <p class="font-semibold">Converse</p>
                <p>Chuck Taylor 70's Hi Sneakers</p>
                <p>Ukuran: EU 42</p>
                <div class="mt-2">
                    <label for="quantity" class="mr-2">Jml:</label>
                    <select id="quantity" class="border border-gray-400 rounded-lg px-2 py-1">
                        <option value="1">1</option>
                        <!-- Tambahkan opsi lainnya jika diperlukan -->
                    </select>
                </div>
            </div>
        </div>
        <div class="text-right">
            <p class="text-red-500 text-xl font-semibold">Rp 974.250</p>
            <p class="line-through">Rp 1.299.000</p>
            <p class="text-sm">- 25%</p>
            <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg">
                Checkout
            </button>
        </div>
        <!-- <button class="text-gray-500 text-xl ml-4">×</button> -->
    </div>
</div>

<div class="bg-white p-4 rounded-lg shadow-md">
    <!-- Section untuk Batik Tibodunyo -->
    <div class="flex items-center mb-4">
        <div class="flex items-center justify-center w-10 h-10 bg-gray-200 rounded-full mr-4">
            <i class="fas fa-store"></i>
        </div>
        <div>
            <p class="font-semibold">Batik Tibodunyo </p>
        </div>
    </div>
    <div class="bg-gray-50 p-4 rounded-lg shadow-inner flex items-center justify-between">
        <div class="flex items-center">
            <input class="mr-4" type="checkbox" />
            <img 
                class="w-20 h-20 object-cover mr-4" 
                src="https://storage.googleapis.com/a1aa/image/oeogpKvqQXwdE6kzu5voI5cb3SffGDmXalChsjbKxmeR0MLPB.jpg" 
                alt="Black high-top sneaker" 
                width="100" 
                height="100" 
            />
            <div>
                <p class="font-semibold">Converse</p>
                <p>Chuck Taylor 70's Hi Sneakers</p>
                <p>Ukuran: EU 42</p>
                <div class="mt-2">
                    <label for="quantity" class="mr-2">Jml:</label>
                    <select id="quantity" class="border border-gray-400 rounded-lg px-2 py-1">
                        <option value="1">1</option>
                        <!-- Tambahkan opsi lainnya jika diperlukan -->
                    </select>
                </div>
            </div>
        </div>
        <div class="text-right">
            <p class="text-red-500 text-xl font-semibold">Rp 974.250</p>
            <p class="line-through">Rp 1.299.000</p>
            <p class="text-sm">- 25%</p>
        </div>
        <!-- <button class="text-gray-500 text-xl ml-4">×</button> -->
    </div>
</div>

</div>
