<div id="createDivisionRecipientModal" class="fixed inset-0 hidden justify-center items-center bg-gray-900 bg-opacity-50 z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
    <h2 class="text-lg font-bold mb-4">Add DCP Recipient Division Office</h2>
        <form action="{{ route('recipients.division.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>Region</label>
                    <select name="region" class="form-select" required>
                        @foreach ($regionalOffices as $region)
                            <option value="{{ $region->ro_office }}">{{ $region->ro_office }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Division</label>
                    <select name="division_id" class="form-select" required>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-input" />
                </div>
                <div>
                    <label>Office</label>
                    <input type="text" name="office" class="form-input" />
                </div>
                <div>
                    <label>SDO Address</label>
                    <input type="text" name="sdo_address" class="form-input" />
                </div>
                <div>
                    <label>Contact Person</label>
                    <input type="text" name="contact_person" class="form-input" />
                </div>
                <div>
                    <label>Position</label>
                    <input type="text" name="position" class="form-input" />
                </div>
                <div>
                    <label>Contact Number</label>
                    <input type="text" name="contact_number" class="form-input" />
                </div>
            </div>
            <div class="mt-4 text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
            </div>
        </form>
  </div>
</div>
