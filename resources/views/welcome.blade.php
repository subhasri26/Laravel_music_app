<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Tabs</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        
        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .tab-link {
            padding: 10px 20px;
            background-color: #ddd;
            border: none;
            cursor: pointer;
        }
        
        .tab-link.active {
            background-color: #aaa;
        }
        
        .tab-content {
            display: none;
            padding: 20px;
            height: 100vh;
        }
        
        .tab-content.active {
            display: block;
        }
        
        #user-section {
            background-color: #f1f1f1;
            background-image: url("{{ asset('images/images.png') }}");
            background-size: cover;
            background-position: center;
            color: #333;
            height: 100%;
        }
        #musician-section {
            background-color: #eaeaea;
            background-image: url("{{ asset('images/images_get.jpg') }}");
            background-size: cover;
            background-position: center;
            color: #333;
            height: 100%; 
        }
    </style>
</head>
<body>
    <div class="tabs">
        <button class="tab-link active" onclick="openTab(event, 'user-tab')">User</button>
        <button class="tab-link" onclick="openTab(event, 'musician-tab')">Musician</button>
            <button class="tab-link" onclick="openTab(event, 'admin-tab')">Admin</button>

    </div>

    <div id="user-tab" class="tab-content active">
        <div id="user-section">
            <h2>User Tab Content</h2>
            <p><h1>
                <a href="{{ url('/user/login') }}">
                    Click here to view Details
                </a>
            </h1>
        </p>

        </div>
    </div>

    <div id="musician-tab" class="tab-content">
        <div id="musician-section">
            <h2>Musician Tab Content</h2>
            <h1><a href="{{ url('/musician/register')}}">Register as a musician</a></h1>
        </div>
    </div>
    <div id="admin-tab" class="tab-content">
    <div id="admin-section">
        <h2>Admin Tab Content</h2>
        <h1><a href="{{ url('/admin/login') }}">Click Here for Admin Login</a></h1>
    </div>
</div>
    <script>
       function openTab(evt, tabName) {
    var tabContents = document.getElementsByClassName('tab-content');
    for (var i = 0; i < tabContents.length; i++) {
        tabContents[i].style.display = 'none';
    }

    var tabLinks = document.getElementsByClassName('tab-link');
    for (var i = 0; i < tabLinks.length; i++) {
        tabLinks[i].className = tabLinks[i].className.replace(' active', '');
    }
    document.getElementById(tabName).style.display = 'block';
    evt.currentTarget.className += ' active';
}
    </script>
</body>
</html>