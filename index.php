<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreshTrack</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
</head>
<body class="bg-white text-gray-900 antialiased">
    <!-- Navbar -->
    <header class="fixed inset-x-0 top-0 z-50 bg-gray-900/40 backdrop-blur-md border-b border-white/10 transition-all duration-300" id="navbar">
      <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
          <a href="#" class="-m-1.5 p-1.5 flex items-center gap-2">
            <span class="sr-only">FreshTrack</span>
            <img class="h-10 w-auto" src="assets/Logo_FreshTrack.png" alt="FreshTrack" onerror="this.outerHTML='<span class=\'text-2xl font-bold text-white\'>FreshTrack</span>'">
          </a>
        </div>
        
        <!-- Mobile menu button -->
        <div class="flex lg:hidden">
          <button type="button" id="mobile-menu-btn" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-white">
            <span class="sr-only">Open main menu</span>
            <i class="fas fa-bars text-xl"></i>
          </button>
        </div>

        <div class="hidden lg:flex lg:gap-x-12">
          <a href="#" class="text-sm/6 font-semibold text-white hover:text-emerald-400 transition-colors">Home</a>
          <a href="#features" class="text-sm/6 font-semibold text-white hover:text-emerald-400 transition-colors">Features</a>
          <a href="#process" class="text-sm/6 font-semibold text-white hover:text-emerald-400 transition-colors">How It Works</a>
          <a href="#testimonials" class="text-sm/6 font-semibold text-white hover:text-emerald-400 transition-colors">Testimonials</a>
          <a href="#aboutus" class="text-sm/6 font-semibold text-white hover:text-emerald-400 transition-colors">About Us</a>
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
          <a href="auth/login.php" class="rounded-full bg-emerald-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 transition-all">START NOW!</a>
        </div>
      </nav>

      <!-- Mobile menu (Extend Navbar) -->
      <div class="lg:hidden hidden border-t border-white/10 bg-gray-900/90 backdrop-blur-md transition-all duration-300" id="mobile-menu">
        <div class="space-y-1 px-6 pb-6 pt-2">
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-800 mobile-link">Home</a>
          <a href="#features" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-800 mobile-link">Features</a>
          <a href="#process" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-800 mobile-link">How It Works</a>
          <a href="#testimonials" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-800 mobile-link">Testimonials</a>
          <a href="#aboutus" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-800 mobile-link">About Us</a>
          <a href="auth/login.php" class="block rounded-md px-3 py-2 text-base font-medium text-emerald-400 hover:bg-gray-800">START NOW!</a>
        </div>
      </div>
    </header>

    <main>
      <!-- Hero section with Background Image -->
      <div class="relative isolate min-h-screen flex items-center justify-center pt-14">
        <!-- Background image -->
        <img src="assets/hero-pic.jpg" alt="Fresh produce" class="absolute inset-0 -z-20 h-full w-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1488459716781-31db52582fe9?q=80&w=2070&auto=format&fit=crop'">
        
        <!-- Overlay -->
        <div class="absolute inset-0 -z-10 bg-gray-900/60 sm:bg-gray-900/70"></div>
        
        <div class="mx-auto max-w-4xl px-6 lg:px-8 text-center py-24 sm:py-32">
            <span class="inline-block rounded-full bg-emerald-500/20 px-4 py-1 text-sm/6 font-semibold text-emerald-300 ring-1 ring-inset ring-emerald-500/30 mb-8 backdrop-blur-sm">🚀 Smart Grocery Tracker</span>
            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl drop-shadow-lg">Never Forget What's in Your Fridge Again.</h1>
            <p class="mt-8 text-lg/8 font-medium text-gray-200 drop-shadow-md">The easiest way to manage your groceries. FreshTrack automatically sorts your food by expiration date and sends you smart reminders so you know exactly what to cook today.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
              <a href="auth/login.php" class="rounded-full bg-emerald-600 px-8 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 transition-all flex items-center gap-2">
                <i class="fas fa-rocket"></i> Start Tracking Your Groceries
              </a>
              <a href="#features" class="text-sm/6 font-semibold text-white flex items-center gap-1 hover:text-emerald-300 transition-colors">Our Features <span aria-hidden="true">→</span></a>
            </div>
        </div>
      </div>

      <!-- Stats section -->
      <div id="about" class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-2">
            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
              <dt class="text-base/7 text-gray-600">Tons of food wasted globally/year</dt>
              <dd class="order-first text-4xl font-semibold tracking-tight text-emerald-600 sm:text-6xl">1.3B</dd>
            </div>
            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
              <dt class="text-base/7 text-gray-600">Average household food waste/year</dt>
              <dd class="order-first text-4xl font-semibold tracking-tight text-emerald-600 sm:text-6xl">$1,500</dd>
            </div>
            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
              <dt class="text-base/7 text-gray-600">Food waste reduction with tracking</dt>
              <dd class="order-first text-4xl font-semibold tracking-tight text-emerald-600 sm:text-6xl">40%</dd>
            </div>
            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
              <dt class="text-base/7 text-gray-600">To set up your digital pantry</dt>
              <dd class="order-first text-4xl font-semibold tracking-tight text-emerald-600 sm:text-6xl">5min</dd>
            </div>
          </dl>
        </div>
      </div>

      <!-- Feature section 2 (Fitur Unggulan) -->
      <div id="features" class="bg-gray-50 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Everything Your Kitchen Needs</h2>
            <p class="mt-6 text-lg/8 text-gray-600">From tracking to recipes, FreshTrack is your complete food management companion.</p>
          </div>
          <div class="mx-auto mt-16 max-w-7xl sm:mt-20 lg:mt-24">
            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-8 lg:max-w-none lg:grid-cols-3">
              <!-- Card 1 -->
              <div class="flex flex-col bg-white rounded-2xl shadow-sm border border-gray-200 p-8 animate-slide-up delay-100">
                <dt class="text-xl font-semibold text-gray-900">
                  <div class="mb-4 flex size-12 items-center justify-center rounded-xl bg-emerald-100">
                    <i class="fas fa-box text-emerald-600"></i>
                  </div>
                  Smart Inventory
                </dt>
                <dd class="mt-2 text-base/7 text-gray-600">Add, edit, and organize all your food items by category. Full CRUD control over your kitchen pantry.</dd>
              </div>
              
              <!-- Card 2 (Highlighted) -->
              <div class="flex flex-col bg-emerald-500 rounded-2xl shadow-md border border-emerald-500 p-8 transform scale-105 animate-slide-up delay-200">
                <dt class="text-xl font-semibold text-white">
                  <div class="mb-4 flex size-12 items-center justify-center rounded-xl bg-emerald-400/30 ring-1 ring-white/20">
                    <i class="fas fa-bell text-white"></i>
                  </div>
                  Expiry Reminders
                </dt>
                <dd class="mt-2 text-base/7 text-emerald-50">Get alerts 1, 3, or 7 days before food expires. Never let anything go bad unnoticed.</dd>
              </div>

              <!-- Card 3 -->
              <div class="flex flex-col bg-white rounded-2xl shadow-sm border border-gray-200 p-8 animate-slide-up delay-300">
                <dt class="text-xl font-semibold text-gray-900">
                  <div class="mb-4 flex size-12 items-center justify-center rounded-xl bg-orange-100">
                    <i class="fas fa-utensils text-orange-600"></i>
                  </div>
                  Quick Recipes
                </dt>
                <dd class="mt-2 text-base/7 text-gray-600">Discover fast recipes for ingredients nearing expiry. Turn expiring food into delicious meals.</dd>
              </div>

              <!-- Card 4 -->
              <div class="flex flex-col bg-white rounded-2xl shadow-sm border border-gray-200 p-8 animate-slide-up delay-100">
                <dt class="text-xl font-semibold text-gray-900">
                  <div class="mb-4 flex size-12 items-center justify-center rounded-xl bg-blue-100">
                    <i class="fas fa-chart-line text-blue-600"></i>
                  </div>
                  Waste Tracking
                </dt>
                <dd class="mt-2 text-base/7 text-gray-600">Monitor your food waste patterns over time and see how much money you've saved.</dd>
              </div>

              <!-- Card 5 -->
              <div class="flex flex-col bg-white rounded-2xl shadow-sm border border-gray-200 p-8 animate-slide-up delay-200">
                <dt class="text-xl font-semibold text-gray-900">
                  <div class="mb-4 flex size-12 items-center justify-center rounded-xl bg-purple-100">
                    <i class="fas fa-tags text-purple-600"></i>
                  </div>
                  Category System
                </dt>
                <dd class="mt-2 text-base/7 text-gray-600">Automatically group your items into meats, vegetables, dairy, and pantry staples.</dd>
              </div>

              <!-- Card 6 -->
              <div class="flex flex-col bg-white rounded-2xl shadow-sm border border-gray-200 p-8 animate-slide-up delay-300">
                <dt class="text-xl font-semibold text-gray-900">
                  <div class="mb-4 flex size-12 items-center justify-center rounded-xl bg-teal-100">
                    <i class="fas fa-lock text-teal-600"></i>
                  </div>
                  Private & Secure
                </dt>
                <dd class="mt-2 text-base/7 text-gray-600">Your personal inventory data is stored securely and is only accessible by you.</dd>
              </div>
            </dl>
          </div>
        </div>
      </div>

      <!-- Process section -->
      <div id="process" class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
          <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-sm font-semibold text-emerald-700">Simple Process</span>
          <h2 class="mt-4 text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Ready in 3 Simple Steps</h2>
          
          <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
              <div class="flex flex-col items-center text-center animate-slide-up delay-100">
                <div class="mb-6 flex size-16 items-center justify-center rounded-2xl bg-emerald-500 shadow-md shadow-emerald-500/20">
                  <span class="text-2xl font-bold text-white">1</span>
                </div>
                <dt class="text-xl font-semibold text-gray-900">Create Account</dt>
                <dd class="mt-2 flex flex-auto flex-col text-base/7 text-gray-600">
                  <p class="flex-auto">Sign up in seconds, completely free. Your private kitchen dashboard awaits.</p>
                </dd>
              </div>
              <div class="flex flex-col items-center text-center animate-slide-up delay-200">
                <div class="mb-6 flex size-16 items-center justify-center rounded-2xl bg-emerald-500 shadow-md shadow-emerald-500/20">
                  <span class="text-2xl font-bold text-white">2</span>
                </div>
                <dt class="text-xl font-semibold text-gray-900">Add Your Groceries</dt>
                <dd class="mt-2 flex flex-auto flex-col text-base/7 text-gray-600">
                  <p class="flex-auto">Input each item with its name, category, and expiration date in under a minute.</p>
                </dd>
              </div>
              <div class="flex flex-col items-center text-center animate-slide-up delay-300">
                <div class="mb-6 flex size-16 items-center justify-center rounded-2xl bg-emerald-500 shadow-md shadow-emerald-500/20">
                  <span class="text-2xl font-bold text-white">3</span>
                </div>
                <dt class="text-xl font-semibold text-gray-900">Never Waste Again</dt>
                <dd class="mt-2 flex flex-auto flex-col text-base/7 text-gray-600">
                  <p class="flex-auto">Receive smart alerts before food expires and discover recipes to use it all up.</p>
                </dd>
              </div>
            </dl>
          </div>
        </div>
      </div>

      <!-- Testimonials -->
      <div id="testimonials" class="bg-gray-900 py-24 sm:py-32 border-t border-gray-800">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl">
            <h2 class="text-base/8 font-semibold text-emerald-400">Testimonials</h2>
            <p class="mt-2 text-4xl font-semibold tracking-tight text-white sm:text-5xl">What They Say</p>
            <p class="mt-6 text-lg/8 text-gray-300">FreshTrack users share their experiences saving food from the trash.</p>
          </div>
          <dl class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-10 text-white sm:mt-20 sm:grid-cols-3 sm:gap-y-16 lg:mx-0 lg:max-w-none">
            <div class="flex flex-col gap-y-3 border-l-2 border-emerald-500 pl-6 animate-slide-up delay-100">
              <dt class="text-sm/6 italic">"Since using FreshTrack, my home food waste has dropped drastically. I always know what to cook first!"</dt>
              <dd class="order-first text-lg font-semibold tracking-tight text-emerald-400">Sarah, Housewife</dd>
            </div>
            <div class="flex flex-col gap-y-3 border-l-2 border-emerald-500 pl-6 animate-slide-up delay-200">
              <dt class="text-sm/6 italic">"As a student, I often forget food in the fridge until it goes bad. FreshTrack helps me save my allowance!"</dt>
              <dd class="order-first text-lg font-semibold tracking-tight text-emerald-400">Dimas, Student</dd>
            </div>
            <div class="flex flex-col gap-y-3 border-l-2 border-emerald-500 pl-6 animate-slide-up delay-300">
              <dt class="text-sm/6 italic">"The quick recipe feature is so useful! I get cooking ideas from ingredients that are almost expired."</dt>
              <dd class="order-first text-lg font-semibold tracking-tight text-emerald-400">Rina, Food Vendor</dd>
            </div>
          </dl>
        </div>
      </div>

      <!-- CTA section -->
      <div class="relative isolate px-6 py-32 sm:py-40 lg:px-8 bg-emerald-900 overflow-hidden border-t border-emerald-800">
        <svg aria-hidden="true" class="absolute inset-0 -z-10 size-full mask-[radial-gradient(100%_100%_at_top_right,white,transparent)] stroke-emerald-800">
          <defs>
            <pattern id="cta-pattern" width="200" height="200" x="50%" y="0" patternUnits="userSpaceOnUse">
              <path d="M.5 200V.5H200" fill="none" />
            </pattern>
          </defs>
          <svg x="50%" y="0" class="overflow-visible fill-emerald-800/50">
            <path d="M-200 0h201v201h-201Z M600 0h201v201h-201Z M-400 600h201v201h-201Z M200 800h201v201h-201Z" stroke-width="0" />
          </svg>
          <rect width="100%" height="100%" fill="url(#cta-pattern)" stroke-width="0" />
        </svg>
        <div class="mx-auto max-w-2xl text-center">
          <h2 class="text-4xl font-semibold tracking-tight text-white sm:text-5xl">Start Now Free!</h2>
          <p class="mx-auto mt-6 max-w-xl text-lg/8 text-emerald-100">FreshTrack is a household inventory management web application specifically designed to reduce food waste at the family level.</p>
          <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="auth/login.php" class="rounded-full bg-white px-8 py-3.5 text-sm font-semibold text-emerald-600 shadow-sm hover:bg-emerald-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 transition-all">Join Now</a>
          </div>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white" id="aboutus">
      <div class="mx-auto max-w-7xl px-6 pt-16 pb-8 sm:pt-24 lg:px-8 lg:pt-32">
        <div class="xl:grid xl:grid-cols-3 xl:gap-8">
          <div class="space-y-8">
            <img src="assets/Logo_FreshTrack.png" alt="FreshTrack" class="h-9" onerror="this.outerHTML='<span class=\'text-2xl font-bold text-emerald-600\'>FreshTrack</span>'" />
            <p class="text-sm/6 text-balance text-gray-600">FreshTrack is a household inventory management web application specifically designed to reduce food waste at the family level.</p>
            <div class="flex gap-x-6">
              <a href="https://www.instagram.com/vctrswrld" class="text-gray-600 hover:text-emerald-600">
                <span class="sr-only">Instagram</span>
                <i class="fab fa-instagram size-6 text-xl"></i>
              </a>
              <a href="https://x.com/UGMYogyakarta" class="text-gray-600 hover:text-emerald-600">
                <span class="sr-only">X</span>
                <i class="fab fa-twitter size-6 text-xl"></i>
              </a>
              <a href="https://www.youtube.com/@Vctrswrld" class="text-gray-600 hover:text-emerald-600">
                <span class="sr-only">YouTube</span>
                <i class="fab fa-youtube size-6 text-xl"></i>
              </a>
            </div>
          </div>
          <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
            <div class="md:grid md:grid-cols-2 md:gap-8">
              <div>
                <h3 class="text-sm/6 font-semibold text-gray-900">Features</h3>
                <ul role="list" class="mt-6 space-y-4">
                  <li><a href="#features" class="text-sm/6 text-gray-600 hover:text-emerald-600">Smart Inventory</a></li>
                  <li><a href="#features" class="text-sm/6 text-gray-600 hover:text-emerald-600">Expiry Reminder</a></li>
                  <li><a href="#features" class="text-sm/6 text-gray-600 hover:text-emerald-600">Quick Recipes</a></li>
                  <li><a href="#features" class="text-sm/6 text-gray-600 hover:text-emerald-600">Waste Tracking</a></li>
                  <li><a href="#features" class="text-sm/6 text-gray-600 hover:text-emerald-600">Category System</a></li>
                  <li><a href="#features" class="text-sm/6 text-gray-600 hover:text-emerald-600">Private & Secure</a></li>
                </ul>
              </div>
              <div class="mt-10 md:mt-0">
                <h3 class="text-sm/6 font-semibold text-gray-900">Support</h3>
                <ul role="list" class="mt-6 space-y-4">
                  <li><a href="wa.link/szvu83" class="text-sm/6 text-gray-600 hover:text-emerald-600">Help Center</a></li>
                  <li><a href="#process" class="text-sm/6 text-gray-600 hover:text-emerald-600">User Guide</a></li>
                  <li><a href="wa.link/4o7bf8" class="text-sm/6 text-gray-600 hover:text-emerald-600">Contact Us</a></li>
                </ul>
              </div>
            </div>
            <div class="md:grid md:grid-cols-2 md:gap-8">
              <div>
                <h3 class="text-sm/6 font-semibold text-gray-900">Company</h3>
                <ul role="list" class="mt-6 space-y-4">
                  <li><a href="#aboutus" class="text-sm/6 text-gray-600 hover:text-emerald-600">About Us</a></li>
                  <li><a href="#" class="text-sm/6 text-gray-600 hover:text-emerald-600">Blog</a></li>
                  <li><a href="#" class="text-sm/6 text-gray-600 hover:text-emerald-600">Careers</a></li>
                </ul>
              </div>
              <div class="mt-10 md:mt-0">
                <h3 class="text-sm/6 font-semibold text-gray-900">Legal</h3>
                <ul role="list" class="mt-6 space-y-4">
                  <li><a href="#" class="text-sm/6 text-gray-600 hover:text-emerald-600">Terms & Conditions</a></li>
                  <li><a href="#" class="text-sm/6 text-gray-600 hover:text-emerald-600">Privacy Policy</a></li>
                  <li><a href="#" class="text-sm/6 text-gray-600 hover:text-emerald-600">License</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-16 border-t border-gray-900/10 pt-8 sm:mt-20 lg:mt-24">
          <p class="text-sm/6 text-gray-600">&copy; 2026 FreshTrack. Reduce food waste starting from your kitchen.</p>
        </div>
      </div>
    </footer>

    <script src="js/main.js?v=<?php echo time(); ?>"></script>
</body>
</html>