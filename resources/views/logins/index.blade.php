<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Fit to Work</title>
    
    <!-- Tambahkan Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background: url('background_login.png') no-repeat center center fixed; background-size: cover;">
    <!-- Header Atas -->
   <header style="background: #ffffff; padding: 20px 30px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
        <img src="logo_astratech.png" alt="ASTRAtech Logo" style="max-height: 50px;">
    </header>

    <!-- Container Utama -->
    <div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
        <!-- Konten Utama -->
        <main style="display: flex; justify-content: flex-end; align-items: center; margin-top: 30px;">
            <!-- Kotak Login -->
            <div style="width: 400px; padding: 20px; background: rgba(255, 255, 255, 0.9); border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                <h2 style="text-align: center; margin-bottom: 20px;">Login Fit to Work</h2>
                <form action="#" method="POST">
                    <!-- Nama Akun -->
                    <div style="margin-bottom: 15px;">
                        <label for="username" style="display: block; margin-bottom: 5px;">Nama Akun <span style="color: red;">*</span></label>
                        <input type="text" id="username" name="username" required style="width: 93%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    </div>
                    <!-- Kata Sandi -->
                    <div style="margin-bottom: 15px;">
                        <label for="password" style="display: block; margin-bottom: 5px;">Kata Sandi <span style="color: red;">*</span></label>
                        <input type="password" id="password" name="password" required style="width: 93%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    </div>

                    <!-- Captcha -->
                <div style="margin-bottom: 15px;">
                    <label for="captcha" style="display: block; margin-bottom: 5px;">Captcha <span style="color: red;">*</span></label>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <!-- Captcha Number -->
                        <span id="captcha-value" style="font-size: 20px; font-weight: bold; background: #f0f0f0; padding: 5px 10px; border-radius: 4px;">
                            <?php echo rand(100000, 999999); ?>
                        </span>
                        
                        <!-- Input Field -->
                        <input type="text" id="captcha" name="captcha" required style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                        
                        <!-- Refresh Button -->
                        <button type="button" id="refresh-captcha" style="background: #007BFF; color: #ffffff; border: none; padding: 10px; border-radius: 4px; cursor: pointer;">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>

                <script>
                    // Refresh Captcha Button Logic
                    document.getElementById('refresh-captcha').addEventListener('click', function() {
                        // Generate new random number for Captcha
                        const newCaptcha = Math.floor(100000 + Math.random() * 900000); // Generate 6-digit number
                        
                        // Update the Captcha value in the DOM
                        document.getElementById('captcha-value').textContent = newCaptcha;
                    });
                </script>


                    <!-- Masuk Buttons -->
                    <div style="display: flex; justify-content: center; margin: 15px 0;">
                        <button type="submit" style="background: #008c4a; color: #ffffff; border: none; padding: 10px 15px; width: 100%; border-radius: 4px; cursor: pointer; font-size: 16px;">Masuk</button>
                    </div>

                    <!-- Links -->
                    <div style="text-align: position: absolute; left: 20px; bottom: 10px;">
                        <a href="#" style="display: block; color: #007BFF; text-decoration: none; margin-bottom: 5px;">Lupa Kata Sandi? Klik disini.</a>
                        <a href="#" style="display: block; color: #007BFF; text-decoration: none; margin-bottom: 5px;">Login sebagai Mitra Kerja? Klik disini.</a>
                        <a href="#" style="display: block; color: #007BFF; text-decoration: none;">Login sebagai Tamu? Klik disini.</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

   <!-- Footer -->
<footer style="background: #ffffff; padding: 50px 70px; position: relative; margin-top: 30px; box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1); font-size: 16px; color: #666;">
    <div style="position: center; left: 20px; bottom: 10px; font-weight: bold;">
        Copyright © 2024 - MIS Politeknik Astra
    </div>
</footer>

</body>
</html>
