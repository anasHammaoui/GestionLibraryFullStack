document.addEventListener("DOMContentLoaded",()=>{
    let searchResult;
let allBooks = document.querySelector(".all-books");
let searchBox = document.querySelector(".searchBox");
let oldContent = document.querySelector(".all-books").innerHTML;
searchBox.addEventListener("keyup",()=>{
    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            searchResult = this.responseText;
        }
    }
    xmlHttp.open("GET",`http://localhost/gestionlibraryfullstack/controller/crudbooks.php?search=${searchBox.value}`,true);
    xmlHttp.send();
   searchResult = JSON.parse(searchResult);
    if (searchBox.value != ""){
        searchResult.forEach(s => {
            allBooks.innerHTML = `
                <tr class="text-gray-700 dark:text-gray-400 child">
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
                          ${s.id}
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
                  </tr>
            `
        })
    } else {
            allBooks.innerHTML = oldContent;
    }
})

})

