fetch('get_menus.php')
    .then(response => response.json())  // แปลงข้อมูลจาก PHP เป็น JSON
    .then(menus => {
        console.log(menus);  // ดูข้อมูลที่ดึงมาใน Console
        const menuList = document.getElementById('menu-list');
        if (menus.length > 0) {
            menus.forEach(menu => {
                const menuItem = document.createElement('div');
                menuItem.classList.add('menu-item');
                menuItem.innerHTML = `
                    <a href="menu-details.html?id=${menu.id}">
                        <img src="${menu.image}" alt="${menu.name}">
                        <p>${menu.name}</p>
                    </a>
                `;
                menuList.appendChild(menuItem);  // เพิ่มเมนูลงในหน้าเว็บ
            });
        } else {
            menuList.innerHTML = "<p>ไม่พบข้อมูลเมนู</p>";
        }
    })
    .catch(error => console.error('Error fetching menu data:', error));
