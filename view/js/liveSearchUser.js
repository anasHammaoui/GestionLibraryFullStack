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
                              
                    
                      </div>
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