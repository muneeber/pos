<div class=" p-4 pt-2">
    <div class="bg-white rounded p-3 flex justify-around  items-center">
        <h1 class=" text-2xl  font-bold ">Accounts</h1>
        <button wire:click='show' class="btn btn-sm   btn-outline">New Account</button>

    </div>
    <div class="overflow-x-auto bg-white rounded shadow-md">
        <table class="table table-zebra">
          <!-- head -->
          <thead>
            <tr>
              <th>Id</th>
              <th><span class="ml-6 ">User</span></th>
              <th>Contact</th>
              <th>Debt</th>
              <th>Options</th>
            </tr>
          </thead>
          <tbody>
            <!-- row 1 -->
            @foreach ($accounts as $account)
                
            <tr>
                <td>{{ $account->id }}</td>
                <td>
                    <div class="flex items-center gap-3">
                      <div class="avatar">
                        <div class="mask mask-squircle w-12 h-12">
                          <img src="https://api.dicebear.com/8.x/lorelei/svg?seed={{ $account->id }}" />
                        </div>
                      </div>
                      <div>
                        <div class="font-bold">{{ $account->Name }}</div>
                      </div>
                    </div>
                  </td>
          
               
                {{-- <td></td> --}}
                <td>{{ $account->Contact }}</td>
                <th>{{ $account->credit_balance }}</th>
                <td><a href="#" class="btn btn-sm rounded text-white btn-success">Details</a></td>
            </tr> 
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="{{ $state }}">
        <link href="{{ asset('css/flowbite.css') }}" rel="stylesheet" />
      <div class="flex justify-center items-center h-screen ">
        <div id="modal" class="fixed top-0 left-0 w-full h-full bg-gray-900  !bg-opacity-50 flex justify-center  items-center ">
          <div class="bg-white p-8 rounded shadow-lg">
                  <!-- Modal header -->
                  <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                          Create New Product
                      </h3>
                      <button wire:click='close' type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                          </svg>
                          <span class="sr-only">Close modal</span>
                      </button>
                  </div>
                  <!-- Modal body -->
                  <form class="p-4 md:p-5" wire:submit.prevent='submit'>
                      <div class="grid gap-4 mb-4 grid-cols-2">
                          <div class="col-span-2">
                              <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                              <input wire:model='name' type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type the Customer name" required="">
                              @error('name')
                                  <p class="bg-red-600 text-white">{{ $message }}</p>
                              @enderror
                          </div>
                          <div class="col-span-2 sm:col-span-1">
                              <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact #</label>
                              <input wire:model='contact' type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="03123456789"  required="">
                              @error('contact')
                              <p class="bg-red-600 text-white">{{ $message }}</p>
                          @enderror
                          </div>
                          <div class="col-span-2 sm:col-span-1">
                            <label for="id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Id Card #</label>
                            <input wire:model='idCard' type="number" name="price" id="id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter Customer's Id Card Number"   required="">
                            @error('idCard')
                            <p class="bg-red-600 text-white">{{ $message }}</p>
                        @enderror
                        </div>
                          <div class="col-span-2">
                              <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                              <textarea id="description" wire:model='address' rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write Customer's address here"></textarea>         
                              @error('address')
                              <p class="bg-red-600 text-white">{{ $message }}</p>
                          @enderror           
                          </div>
                      </div>
                      <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                          <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                          Add new Customer
                      </button>
                  </form>
        </div>
      </div>
    </div>
    </div>
    
      {{-- <script src="avatar.js" type="module"></script> --}}
</div>
