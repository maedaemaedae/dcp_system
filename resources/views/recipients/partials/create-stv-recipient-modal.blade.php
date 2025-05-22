<div id="createStvRecipientModal" class="fixed inset-0 hidden justify-center items-center bg-gray-900 bg-opacity-50 z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
    <h2 class="text-lg font-bold mb-4">Add DCP Recipient School (STV)</h2>
    <form action="{{ route('recipients.stv.store') }}" method="POST">
      @csrf
     <label>Region</label>
        <select name="regional_office_id" class="w-full border rounded px-3 py-2" required>
            <option value="">Select Regional Office</option>
                @foreach($regionalOffices as $ro)
                    <option value="{{ $ro->ro_id }}">{{ $ro->ro_office }}</option>
                @endforeach
        </select>
      <label>Division</label>
      
      <input type="text" name="division" required class="w-full border rounded px-3 py-2 mb-3">
      
      <label>School ID</label>
      <input type="number" name="school_id" required class="w-full border rounded px-3 py-2 mb-3">
      
      <label>School Name</label>
      <input type="text" name="school_name" class="w-full border rounded px-3 py-2 mb-3">
      
      <label>School Address</label>
      <input type="text" name="school_address" class="w-full border rounded px-3 py-2 mb-3">
      
      <label>Quantity</label>
      <input type="number" name="quantity" class="w-full border rounded px-3 py-2 mb-3">
      
      <label>Contact Person</label>
      <input type="text" name="contact_person" class="w-full border rounded px-3 py-2 mb-3">
      
      <label>Position</label>
      <input type="text" name="position" class="w-full border rounded px-3 py-2 mb-3">
      
      <label>Contact Number</label>
      <input type="text" name="contact_number" class="w-full border rounded px-3 py-2 mb-3">

      <div class="flex justify-end gap-2">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
        <button type="button" onclick="closeModal('createStvRecipientModal')" class="px-4 py-2 border rounded">Cancel</button>
      </div>
    </form>
  </div>
</div>
