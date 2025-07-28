<h3 class="text-2xl font-bold mb-4 flex items-center gap-2 text-[#1F2937]">
         <span>Package Types</span>
    </h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($packageTypes as $type)
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                <div class="text-lg font-semibold text-gray-800">{{ $type->package_code }}</div>
                <div class="text-base text-gray-600 mb-2">{{ $type->description }}</div>
                <ul class="text-sm list-disc list-inside text-gray-700">
                    @foreach($type->contents as $item)
                        <li>{{ $item->quantity }} × {{ $item->item_name }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
        <div class="mt-4">
     {{ $packageTypes->appends(['type' => 'package_types'])->links('vendor.pagination.tailwind') }}
</div>
    </div>