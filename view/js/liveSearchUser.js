console.log("hhelo");
let searchBox = document.querySelector(".searchUser");
console.log(searchBox);
let searchRes;
const original = document.querySelector(".booksUser").innerHTML;
let tableBooks = document.querySelector(".booksUser");
searchBox.addEventListener("keyup",()=>{
    let httpXml = new XMLHttpRequest();
    httpXml.onreadystatechange = function (){
        if (this.readyState === 4 && this.status === 200){
            searchRes = JSON.parse(this.responseText);
            console.log(searchRes);
        searchRes.forEach((s,i) =>{
               if (searchBox.value !== ""){
                tableBooks.innerHTML  = `

                            <!-- Book Card -->
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                            <div class="relative h-64">
                                <img src="${s.cover_image}" alt="The Midnight Library" class="w-full h-full object-cover">
                                <span class="absolute top-0 right-0 bg-rose-500 p-2 text-white font-bold">${s.status}</span>
                            </div>
                            <div class="p-4">
                               
                                <h3 class="mt-2 text-xl font-bold text-gray-900">${s.title}</h3>
                                <p class="mt-1 text-gray-600">${s.author}</p>
                                <span class="mt-1 text-gray-600">${s.summary}</span>
                                <button class="mt-4 w-full bg-indigo-600 text-white py-2 px-4 rounded-md flex items-center justify-center gap-2 hover:bg-indigo-700 transition-colors"   aria-label="borrow"
                                onclick="toggleModal('${s.title}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"></path>
                                    </svg>
                                    Borrow Now
                                </button>
                    
                      </div>
                            </div>
                                          <!-- Modal -->
                      <div 
                          id="${s.title}" 
                          class="hidden fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4"
                      >
                          <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl p-6 relative">
                          <?php
                                    if ($showBooks[${i}]["status"] != "borrowed"){ ?>
                                <form action="userDash.php" method="POST" class="space-y-4">
                                  <!-- user Id -->
                                  <div>
                                      <input 
                                          type="text" 
                                          name="user-id" 
                                          value="<?=$_SESSION['userId'] > 
                                          class="mt-1 hidden w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500"
                                      >
                                  </div>

                                  <!-- book id -->
                                  <div>
                                      <input 
                                          type="text" 
                                          name="book-id" 
                                          value="${s.id}" 
                                          class="mt-1 w-full hidden rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500"
                                      >
                                  </div>

                                  <!-- borrow date -->
                                  <div>
                                      <label class="block text-sm font-medium text-gray-700">Borrow Date</label>
                                      <input 
                                          type="date" 
                                          name="date-borrow" 
                                          class="mt-1 border p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500"
                                      >
                                  </div>
                                  <!-- due date -->
                                  <div>
                                      <label class="block text-sm font-medium text-gray-700">Due date</label>
                                      <input 
                                          type="date" 
                                          name="date-due" 
                                          class="mt-1 border p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500"
                                      >
                                  </div>
                                  <!-- return date -->
                                  <div>
                                      <label class="block text-sm font-medium text-gray-700">Return date</label>
                                      <input 
                                          type="date" 
                                          name="date-return" 
                                          class="mt-1 border p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500"
                                      >
                                  </div>

                           

                                  <!-- Actions -->
                                  <div class="flex justify-end gap-3 mt-6">
                                      <button 
                                          type="button"
                                          onclick="toggleModal('${s.cover_image}')"
                                          class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200"
                                      >
                                          Cancel
                                      </button>
                                      <button 
                                          type="submit"
                                          name="borrow"
                                          class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-md hover:bg-purple-700"
                                      >
                                          Borrow Book
                                      </button>
                                  </div>
                              </form>

                                   <?php } else {
                                    echo "the book is already borrowed";
                                   }
                                ?>
                          </div>
                `
               } else {
                tableBooks.innerHTML = original;
               }
        })
        }
    }
    httpXml.open("GET","../controller/search.php?search=" + searchBox.value);
    httpXml.send();
})