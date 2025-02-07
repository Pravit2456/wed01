document.addEventListener("DOMContentLoaded", function () {
    fetch("http://localhost/api/get_menu.php")  // URL ไปยัง PHP API
        .then(response => response.json())
        .then(data => {
            const menuList = document.getElementById("menuList");
            menuList.innerHTML = "";

            data.forEach(item => {
                const menuItem = document.createElement("div");
                menuItem.className = "menu-item";
                menuItem.innerHTML = `
                    <img src="${item.image}" alt="${item.name}">
                    <p><strong>${item.name}</strong></p>
                    <p>${item.ingredients}</p>
                    <p>${item.recipe}</p>
                `;
                menuList.appendChild(menuItem);
            });
        })
        .catch(error => console.error("Error fetching menu:", error));
});
