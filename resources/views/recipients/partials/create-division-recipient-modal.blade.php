<div id="createDivisionRecipientModal" class="fixed inset-0 hidden justify-center items-center bg-gray-900 bg-opacity-50 z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
    <h2 class="text-lg font-bold mb-4">Add DCP Recipient Division Office</h2>
    <form action="{{ route('recipients.division.store') }}" method="POST">
      @csrf
      <label>Region</label>
      <input type="text" name="region" class="w-full border rounded px-3 py-2 mb-3">
      
      <label>Division ID</label>
      <input type="number" name="division_id" required class="w-full border rounded px-3 py-2 mb-3">
      
      <label>Quantity</label>
      <input type="number" name="quantity" class="w-full border rounded px-3 py-2 mb-3">
      
      <label>Office</label>
      <input type="text" name="office" class="w-full border rounded px-3 py-2 mb-3">
      
      <label>SDO Address</label>
      <input type="text" name="sdo_address" class="w-full border rounded px-3 py-2 mb-3">
      
      <label>Contact Person</label>
      <input type="text" name="contact_person" class="w-full border rounded px-3 py-2 mb-3">
      
      <label>Position</label>
      <input type="text" name="position" class="w-full border rounded px-3 py-2 mb-3">
      
      <label>Contact Number</label>
      <input type="text" name="contact_number" class="w-full border rounded px-3 py-2 mb-3">

      <div class="flex justify-end gap-2">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
        <button type="button" onclick="closeModal('createDivisionRecipientModal')" class="px-4 py-2 border rounded">Cancel</button>
      </div>
    </form>
  </div>
</div>
