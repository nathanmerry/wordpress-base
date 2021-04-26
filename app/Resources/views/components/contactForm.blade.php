<div x-data="ContactForm()" class="bg-white px-6 lg:px-12 py-6 lg:py-14 rounded-xl shadow-lg">
  <div class="header-sm mb-5 text-primary">{{ $title }}</div>
  <div class="mb-5 lg:mb-10 text-dark text-lg">{{ $description }}</div>
  <form class="text-dark" x-on:submit="onClickSubmitForm(event)">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-2 mb-5">
      <div class="flex flex-col mb-5 md:mb-0 lg:mr-3">
        <label for="firstName" class="mb-3">First Name</label>
        <input x-model="fields.firstName" type="text" name="firstName" class="p-2 rounded-sm border border-gray-300" required>
      </div>
      <div class="flex flex-col lg:ml-3">
        <label for="lname" class="mb-3">Last Name</label>
        <input x-model="fields.lastName" type="text" name="lname" class="p-2 rounded-sm border border-gray-300" required>
      </div>
    </div>
    <label for="email" class="block mb-3">Email</label>
    <input x-model="fields.email" type="email" name="email" for="email" class="w-full mb-5 p-2 rounded-sm border border-gray-300" required>
    <label for="phone" class="block mb-3">Phone</label>
    <input x-model="fields.phone" type="number" name="phone" class="phone w-full mb-5 p-2 rounded-sm border border-gray-300" required>
    <label for="company" class="block mb-3">Company</label>
    <input x-model="fields.company" type="text" name="company" class="w-full mb-5 p-2 rounded-sm border border-gray-300" required>
    <label for="message" class="block mb-3">Message</label>
    <textarea x-model="fields.message" class="w-full h-32 mb-5 p-2 rounded-sm border border-gray-300 resize-none" required></textarea>

    <div class="flex">
      <button 
        :disabled="loading" 
        class="flex items-center justify-center h-12 w-40 flex-shrink-0 mr-4 bg-green-400 text-white rounded text-lg font-semibold" 
      >
        <div x-cloak x-show="loading" class="loading-ring"></div>
        <span x-show="!loading">SEND MESSAGE</span>
      </button>
      <div class="" x-text="responseMessage"></div>
    </div>
  </form>
</div>
