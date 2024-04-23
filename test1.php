<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>
    <div class="facility-form">
        <form action="addFacility.php" method="POST">

            <label for="facilityName">Facility Name</label><br>
            <input type="text" name="facility" id="facilityName"><br>
            <label for="facilityName">Location</label>
            <div class="custom-select" id="location" name="location">
                <select id="floor" name="floor" class="select-arrow">
                    <option value="">Floor</option>
                    <option value="Grounds">Grounds</option>
                    <option value="2nd Floor">2nd Floor</option>
                    <option value="3rd Floor">3rd Floor</option>
                    <option value="4th Floor">4th Floor</option>
                </select>
            </div>
            <label for="description">Description</label><br><br>
            <textarea class="description" name="description" rows="30" cols="50"></textarea><br>
            <label for="">Access</label><br>
            <input type="radio" id="access" name="access" value="Private">
            <label for="private">Private</label><br>
            <input type="radio" id="access" name="access" value="Public">
            <label for="public">Public</label><br>
            
            <input type="submit" class="button" name="submit" value="Add Facility">
    </div>
</div>
</div>
</form>
</body>
</html>