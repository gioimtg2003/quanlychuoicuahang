<!DOCTYPE html>
<html>
<head>
    <title>Quản lý cửa hàng</title>
    <link rel="stylesheet" href="quanlycuahang.css"></link>
    <style>
        /* CSS cho giao diện trang quản lý cửa hàng */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url("https://png.pngtree.com/thumb_back/fh260/background/20210131/pngtree-abstract-elegant-decorative-wavy-background-with-silver-gentle-lines-in-trendy-image_551289.jpg");
        }
        .store-list {
            max-width: 800px;
            margin: 20px auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
    <script>
        // JavaScript cho trang quản lý cửa hàng
        document.addEventListener("DOMContentLoaded", function() {
            // Mảng chứa danh sách các cửa hàng (dữ liệu mẫu)
            var storeData = [
                {
                    id: 1,
                    name: "Cửa hàng A",
                    address: "Địa chỉ A",
                    city: "Thành phố A"
                },
                {
                    id: 2,
                    name: "Cửa hàng B",
                    address: "Địa chỉ B",
                    city: "Thành phố B"
                },
                {
                    id: 3,
                    name: "Cửa hàng C",
                    address: "Địa chỉ C",
                    city: "Thành phố C"
                },
                {
                    id: 4,
                    name: "Cửa hàng D",
                    address: "Địa chỉ D",
                    city: "Thành phố D"
                },
                // Thêm các cửa hàng khác...
            ];

            var storeTableBody = document.getElementById("store-table-body");

            // Hiển thị danh sách cửa hàng
            storeData.forEach(function(store) {
                var row = document.createElement("tr");

                var idCell = document.createElement("td");
                idCell.textContent = store.id;
                row.appendChild(idCell);

                var nameCell = document.createElement("td");
                nameCell.textContent = store.name;
                row.appendChild(nameCell);

                var addressCell = document.createElement("td");
                addressCell.textContent = store.address;
                row.appendChild(addressCell);

                var cityCell = document.createElement("td");
                cityCell.textContent = store.city;
                row.appendChild(cityCell);

                storeTableBody.appendChild(row);
            });
        });
    </script>
</head>
<body>
    <div class="store-list">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên cửa hàng</th>
                    <th>Địa chỉ</th>
                    <th>Thành phố</th>
                </tr>
            </thead>
            <tbody id="store-table-body">
                <!-- Các cửa hàng sẽ được tạo bằng JavaScript -->
            </tbody>
        </table>
    </div>
</body>
</html>