<div class="border border-blue-400 rounded-lg py-6 px-8 mt-8" id="add-reply-field">
        <form method="POST" action="/tweets/{{ $tweet->id }}/reply">
           @csrf
            
           @if(isset($parentID))
                <input name="parent_id" type="hidden" value="{{ $parentID }}"/>
           @endif
           
           <textarea
               name="body"
               class="w-full focus:outline-none focus:placeholder-gray-700"
               placeholder="Add a reply..."
               autofocus
           ></textarea>
   
           @error('body')
               <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
           @enderror
   
           <hr class="mb-4">
   
           <footer class="flex items-center justify-between">
               <img
                   src="{{ auth()->user()->avatar }}"
                   alt="Your Avatar"
                   class="rounded-full mr-2"
                   width="50"
                   height="50"
               >
               <button type="submit" class="bg-blue-500 rounded-full shadow text-sm px-10 text-white hover:bg-blue-600 h-10">
                   Publish
               </button>
   
           </footer>
   
       </form>
</div>