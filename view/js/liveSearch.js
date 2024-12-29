let searchBox = document.querySelector(".searchBox");
let searchRes;
const original = document.querySelector(".tbody").innerHTML;
let tableBooks = document.querySelector(".tbody");
searchBox.addEventListener("keyup",()=>{
    let httpXml = new XMLHttpRequest();
    httpXml.onreadystatechange = function (){
        if (this.readyState === 4 && this.status === 200){
            searchRes = JSON.parse(this.responseText);
            console.log(searchRes);
        searchRes.forEach(s =>{
               if (searchBox.value !== ""){
                tableBooks.innerHTML =  tableBooks.innerHTML = `
                <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3">
                <div class="flex items-center text-sm">
                <!-- Avatar with inset shadow -->
                <div
                    class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                >
                    <img
                    class="object-cover w-full h-full rounded-full"
                    src="${s.cover_image}"
                    alt="${s.title}"
                    loading="lazy"
                    />
                    <div
                    class="absolute inset-0 rounded-full shadow-inner"
                    aria-hidden="true"
                    ></div>
                </div>
                <div>
                    <p class="font-semibold">${s.title}</p>
                    <p class="text-xs text-gray-600 dark:text-gray-400">
                    ${s.category_id}
                    </p>
                </div>
                </div>
            </td>
            <td class="px-4 py-3 text-sm">
            ${s.author}
            </td>
            <td class="px-4 py-3 text-xs">
                <span
                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                >
                ${s.status}
                </span>
            </td>
            <td class="px-4 py-3 text-sm">
            ${s.created_at}
            </td>
            <td class="px-4 py-3">
                <div class="flex items-center space-x-4 text-sm">
                <!-- Edit Button -->
                <button
                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline-gray"
                    aria-label="Edit"
                    onclick="toggleModal('${s.title}')"
                >
                    <svg
                        class="w-5 h-5"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                        ></path>
                    </svg>
                </button>

                <!-- Modal -->
                <div 
                    id="${s.title}" 
                    class="hidden fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4"
                >
                    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl p-6 relative">
                        <form action="booksAdmin.php" method="POST" class="space-y-4">
                            <!-- Book Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Book Name</label>
                                <input 
                                    type="text" 
                                    name="edit-name" 
                                    value="${s.title}" 
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500"
                                >
                            </div>

                            <!-- Author -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Author Name</label>
                                <input 
                                    type="text" 
                                    name="author-name" 
                                    value="${s.author}" 
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500"
                                >
                            </div>

                            <!-- Description -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea 
                                    name="edit-desc" 
                                    class="mt-1 p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500"
                                >${s.summary}</textarea>
                            </div>

                            <!-- Cover URL -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Cover URL</label>
                                <input 
                                    type="text" 
                                    name="cover-edit" 
                                    value="${s.cover_image}" 
                                    class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500"
                                >
                            </div>

                            <!-- Category -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Category</label>
                                <select 
                                    name="edit-cat"
                                    class="mt-1 p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500"
                                >
                                    <?php foreach($showCats as $cat) { ?>
                                        <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <select 
                                    name="newStatus"
                                    class="mt-1 p-2 w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500"
                                >
                                    <option value="available">Available</option>
                                    <option value="borrowed">Borrowed</option>
                                    <option value="reserved">Reserved</option>
                                </select>
                            </div>

                            <input type="hidden" name="bookId" value="${s.id}">

                            <!-- Actions -->
                            <div class="flex justify-end gap-3 mt-6">
                                <button 
                                    type="button"
                                    onclick="toggleModal('${s.title}')"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200"
                                >
                                    Cancel
                                </button>
                                <button 
                                    type="submit"
                                    name="editBook"
                                    class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-md hover:bg-purple-700"
                                >
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- delete book -->
                <form action="booksAdmin.php" method="POST">
                    <input type="text" name="delete-book" class="hidden" value="${s.id}">
                    <button
                    type="submit"
                    
                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                    aria-label="Delete"
                    name="deleteBook"
                >
                    <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    >
                    <path
                        fill-rule="evenodd"
                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        clip-rule="evenodd"
                    ></path>
                    </svg>
                </button>
                </form>
                </div>
            </td>
            </tr>
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