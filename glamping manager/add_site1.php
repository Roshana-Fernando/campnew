<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register site1</title>
    <link rel="stylesheet" href="glm_css_files/add_site1.css">
</head>
<body>
    
<nav>
      <span  class="as"><img src="../resource/logo.png" alt="" width="150" height="70"></span>
  </nav>

<div class="title">
    <h1>List your glamping site on Campamento and start welcoming guests !</h1><br>
    
</div>


<div class="container">
        <div class="card">
           <div class="card-header">
              Add Glamping Site
           </div>
           <div class="card-body">
                <section id="content">
                   <div class="content-blog bg-white py-3">
                      <div class="container">
                        <form method="post" enctype="multipart/form-data" action="r.php">
    
                            <div class="form-group">
                                <label for="site_name">Site Name</label>
                                <input type="text" class="form-control" name="site_name" id="site_name" placeholder="Site Name">
                            </div>
                            <div class="form-group">
                                <label for="site_description">Site Description</label>
                                <textarea class="form-control" name="site_description" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="site_category">Site Category</label>
                                <select class="form-control" id="site_category" name="site_category">
                                    <option value="Wildglamping">Wild Glamping Site</option>
                                    <option value="Beachglamping">Beach Glamping Site</option>
                                    <option value="Treehouse">Tree House</option>
                                    <option value="Luxurysite">Luxury Site</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="room1_type">Room 1 Type</label>
                                <select class="form-control" id="room1_type" name="room1_type">
                                    <option value="FamilyTent">Family Tent</option>
                                    <option value="LuxuryTent">Luxury Tent</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="room1_price">Room 1 Price (1 night, 2 adults)</label>
                                <input type="text" class="form-control" name="room1_price" id="room1_price" placeholder="Room 1 Price">
                            </div>
                            
                            <div class="form-group">
                                <label for="room2_type">Room 2 Type</label>
                                <select class="form-control" id="room2_type" name="room2_type">
                                    <option value="FamilyTent">Family Tent</option>
                                    <option value="LuxuryTent">Luxury Tent</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="room2_price">Room 2 Price (1 night, 2 adults)</label>
                                <input type="text" class="form-control" name="room2_price" id="room2_price" placeholder="Room 2 Price">
                            </div>
                            <div class="form-group">
                                <label for="siteimage">Site Image</label>
                                <input type="file" name="site_image" id="site_image">
                                <p class="help-block">Only jpg/png are allowed.</p>
                            </div>
                            
                            <button type="submit" name='submit' class="btn btn-primary">Submit</button>
                        </form>
                      </div>
                   </div>
                </section>
           </div>
        </div>
    </div>
    

</body>
</html>
