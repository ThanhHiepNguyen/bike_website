<?php 
require_once 'includes/header.php'; 
$page_title = "Trang Chủ"; 
?>

<!-- Hero Section with Carousel -->
<section id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <!-- Slide 1: Smart Bike Station -->
        <div class="carousel-item active">
            <div class="carousel-slide position-relative" style="background: linear-gradient(rgba(40,167,69,0.7), rgba(32,201,151,0.7)), url('https://images.unsplash.com/photo-1528629297340-d1d466945dc5?q=80&w=2070') center/cover no-repeat; min-height: 600px;">
                <div class="container h-100 d-flex align-items-center">
                    <div class="text-white text-center w-100 animate__animated animate__fadeIn">
                        <h1 class="display-3 fw-bold mb-4">Hệ Thống Xe Đạp Thông Minh</h1>
                        <p class="lead mb-4 px-lg-5">Trạm xe đạp tự động với công nghệ IoT tiên tiến cho thành phố thông minh</p>
                        <div class="d-flex gap-3 justify-content-center">
                            <a href="stations.php" class="btn btn-light btn-lg px-4 rounded-pill shadow-sm">
                                <i class="bi bi-map me-2"></i>Xem Bản Đồ Trạm Xe
                            </a>
                            <a href="register.php" class="btn btn-outline-light btn-lg px-4 rounded-pill">
                                <i class="bi bi-person-plus me-2"></i>Đăng Ký Ngay
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Slide 2: Smart City Integration -->
        <div class="carousel-item">
            <div class="carousel-slide position-relative" style="background: linear-gradient(rgba(40,167,69,0.7), rgba(32,201,151,0.7)), url('https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2070') center/cover no-repeat; min-height: 600px;">
                <div class="container h-100 d-flex align-items-center">
                    <div class="text-white text-center w-100 animate__animated animate__fadeIn">
                        <h1 class="display-3 fw-bold mb-4">Tích Hợp Thành Phố Thông Minh</h1>
                        <p class="lead mb-4 px-lg-5">Kết nối mọi người, mọi nơi với hệ thống giao thông xanh, thông minh</p>
                        <div class="d-flex gap-3 justify-content-center">
                            <a href="#features" class="btn btn-light btn-lg px-4 rounded-pill shadow-sm">
                                <i class="bi bi-info-circle me-2"></i>Tìm Hiểu Thêm
                            </a>
                            <a href="contact.php" class="btn btn-outline-light btn-lg px-4 rounded-pill">
                                <i class="bi bi-envelope me-2"></i>Liên Hệ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Slide 3: Green Transportation -->
        <div class="carousel-item">
            <div class="carousel-slide position-relative" style="background: linear-gradient(rgba(40,167,69,0.7), rgba(32,201,151,0.7)), url('https://images.unsplash.com/photo-1517649763962-0c623066013b?q=80&w=2070') center/cover no-repeat; min-height: 600px;">
                <div class="container h-100 d-flex align-items-center">
                    <div class="text-white text-center w-100 animate__animated animate__fadeIn">
                        <h1 class="display-3 fw-bold mb-4">Giao Thông Xanh, Tương Lai Bền Vững</h1>
                        <p class="lead mb-4 px-lg-5">Góp phần giảm thiểu ô nhiễm, xây dựng môi trường sống xanh cho tương lai</p>
                        <div class="d-flex gap-3 justify-content-center">
                            <a href="stations.php" class="btn btn-light btn-lg px-4 rounded-pill shadow-sm">
                                <i class="bi bi-bicycle me-2"></i>Bắt Đầu Ngay
                            </a>
                            <a href="#stats" class="btn btn-outline-light btn-lg px-4 rounded-pill">
                                <i class="bi bi-graph-up me-2"></i>Số Liệu
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    
    <!-- Wave Shape -->
    <div class="custom-shape-divider-bottom-1681764621">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" fill="#ffffff"></path>
        </svg>
    </div>
</section>

<!-- Features Section -->
<section class="py-5" id="features">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Công Nghệ Thông Minh - Giải Pháp Xanh</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm animate__animated animate__fadeInUp text-center p-4">
                    <div class="card-body">
                        <div class="feature-icon bg-success bg-gradient rounded-circle p-3 mx-auto mb-4" style="width: 80px; height: 80px;">
                            <i class="bi bi-phone display-4 text-white"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3">Ứng Dụng Thông Minh</h3>
                        <p class="text-muted">Quản lý chuyến đi, đặt xe và thanh toán dễ dàng qua ứng dụng di động với giao diện thân thiện.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm animate__animated animate__fadeInUp animate__delay-1s text-center p-4">
                    <div class="card-body">
                        <div class="feature-icon bg-success bg-gradient rounded-circle p-3 mx-auto mb-4" style="width: 80px; height: 80px;">
                            <i class="bi bi-cpu display-4 text-white"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3">Công Nghệ IoT</h3>
                        <p class="text-muted">Hệ thống theo dõi thời gian thực, quản lý xe thông minh và phân tích dữ liệu sử dụng.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm animate__animated animate__fadeInUp animate__delay-2s text-center p-4">
                    <div class="card-body">
                        <div class="feature-icon bg-success bg-gradient rounded-circle p-3 mx-auto mb-4" style="width: 80px; height: 80px;">
                            <i class="bi bi-shield-check display-4 text-white"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3">An Toàn & Bảo Mật</h3>
                        <p class="text-muted">Khóa điện tử thông minh, định vị GPS và bảo hiểm cho mọi chuyến đi của bạn.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Quy Trình Thông Minh</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="text-center">
                    <div class="mb-3">
                        <span class="badge bg-success rounded-circle p-3" style="width: 50px; height: 50px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem;">1</span>
                    </div>
                    <h4 class="h5 fw-bold mb-3">Đăng Ký Tài Khoản</h4>
                    <p class="text-muted">Xác thực nhanh chóng qua số điện thoại hoặc email</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="mb-3">
                        <span class="badge bg-success rounded-circle p-3" style="width: 50px; height: 50px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem;">2</span>
                    </div>
                    <h4 class="h5 fw-bold mb-3">Định Vị Trạm Xe</h4>
                    <p class="text-muted">Tìm trạm gần nhất với bản đồ thời gian thực</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="mb-3">
                        <span class="badge bg-success rounded-circle p-3" style="width: 50px; height: 50px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem;">3</span>
                    </div>
                    <h4 class="h5 fw-bold mb-3">Quét QR & Mở Khóa</h4>
                    <p class="text-muted">Công nghệ mở khóa tự động, nhanh chóng</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="mb-3">
                        <span class="badge bg-success rounded-circle p-3" style="width: 50px; height: 50px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem;">4</span>
                    </div>
                    <h4 class="h5 fw-bold mb-3">Trả Xe & Thanh Toán</h4>
                    <p class="text-muted">Thanh toán tự động, nhận hóa đơn điện tử</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 col-6 mb-4 mb-md-0">
                <h3 class="display-4 fw-bold text-success">500+</h3>
                <p class="text-muted">Xe Đạp</p>
            </div>
            <div class="col-md-3 col-6 mb-4 mb-md-0">
                <h3 class="display-4 fw-bold text-success">50+</h3>
                <p class="text-muted">Trạm Xe</p>
            </div>
            <div class="col-md-3 col-6">
                <h3 class="display-4 fw-bold text-success">10K+</h3>
                <p class="text-muted">Người Dùng</p>
            </div>
            <div class="col-md-3 col-6">
                <h3 class="display-4 fw-bold text-success">100K+</h3>
                <p class="text-muted">Chuyến Đi</p>
            </div>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Đối Tác Của Chúng Tôi</h2>
        <div class="row justify-content-center align-items-center">
            <div class="col-md-2 col-4 mb-4">
                <div class="partner-logo-wrapper text-center p-3 bg-white rounded shadow-sm">
                    <img src="https://upload.wikimedia.org/wikipedia/vi/thumb/9/98/Vingroup_logo.svg/1200px-Vingroup_logo.svg.png" alt="VinGroup" class="img-fluid" style="max-height: 60px;">
                </div>
            </div>
            <div class="col-md-2 col-4 mb-4">
                <div class="partner-logo-wrapper text-center p-3 bg-white rounded shadow-sm">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/FPT_logo_2010.svg/1200px-FPT_logo_2010.svg.png" alt="FPT" class="img-fluid" style="max-height: 60px;">
                </div>
            </div>
            <div class="col-md-2 col-4 mb-4">
                <div class="partner-logo-wrapper text-center p-3 bg-white rounded shadow-sm">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f6/Grab_Logo.svg/800px-Grab_Logo.svg.png" alt="Grab" class="img-fluid" style="max-height: 60px;">
                </div>
            </div>
            <div class="col-md-2 col-4 mb-4">
                <div class="partner-logo-wrapper text-center p-3 bg-white rounded shadow-sm">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/24/Samsung_Logo.svg/2560px-Samsung_Logo.svg.png" alt="Samsung" class="img-fluid" style="max-height: 60px;">
                </div>
            </div>
            <div class="col-md-2 col-4 mb-4">
                <div class="partner-logo-wrapper text-center p-3 bg-white rounded shadow-sm">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Intel_logo_%282020%2C_light_blue%29.svg/1200px-Intel_logo_%282020%2C_light_blue%29.svg.png" alt="Intel" class="img-fluid" style="max-height: 60px;">
                </div>
            </div>
            <div class="col-md-2 col-4 mb-4">
                <div class="partner-logo-wrapper text-center p-3 bg-white rounded shadow-sm">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Bosch-logo.svg/2560px-Bosch-logo.svg.png" alt="Bosch" class="img-fluid" style="max-height: 60px;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- App Download Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="app-showcase position-relative">
                    <!-- Phone mockup with app interface -->
                    <div class="phone-mockup position-relative mx-auto animate__animated animate__fadeInLeft animate__faster" style="max-width: 300px;">
                        <div class="phone-frame p-3 bg-dark rounded-4 shadow-lg">
                            <div class="phone-screen bg-white rounded-3 overflow-hidden">
                                <img src="https://play-lh.googleusercontent.com/PTWX4gLoTLZImbFOEsElKPfI_QEbj1Nwp9UAaqsMboLn8PlPu8cHlJ3H-dFAA8t9F4PL" alt="BikeGo App Interface" class="img-fluid w-100">
                                
                                <!-- Overlay elements with glass effect -->
                                <div class="position-absolute top-0 start-0 w-100 p-3" style="z-index: 2;">
                                    <div class="bg-white bg-opacity-95 rounded-3 shadow p-2 mb-3 animate__animated animate__fadeInDown animate__fast">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="bi bi-bicycle text-success me-2 fs-4"></i>
                                            <h6 class="mb-0 text-success fw-bold">BikeGo</h6>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="position-absolute bottom-0 start-0 w-100 p-3" style="z-index: 2;">
                                    <div class="bg-white bg-opacity-95 rounded-3 shadow p-3 mb-3 animate__animated animate__fadeInUp animate__fast">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-geo-alt-fill text-success me-2"></i>
                                            <small class="fw-medium">Trạm xe gần nhất: 150m</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-bicycle text-success me-2"></i>
                                            <small class="fw-medium">Xe sẵn sàng: 8/10</small>
                                        </div>
                                    </div>
                                    <button class="btn btn-success w-100 rounded-pill shadow animate__animated animate__pulse animate__infinite">
                                        <i class="bi bi-qr-code-scan me-2"></i>Quét QR mở khóa
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Floating elements -->
                    <div class="floating-element position-absolute animate__animated animate__fadeInLeft animate__faster" style="width: 60px; height: 60px; background: linear-gradient(45deg, #28a745, #20c997); border-radius: 12px; top: 10%; left: 0; transform: translate(-50%, -50%) rotate(45deg);"></div>
                    <div class="floating-element position-absolute animate__animated animate__fadeInRight animate__faster" style="width: 80px; height: 80px; background: linear-gradient(45deg, #20c997, #28a745); border-radius: 16px; bottom: 20%; right: 0; transform: translate(50%, 50%) rotate(-15deg);"></div>
                    <div class="floating-element position-absolute animate__animated animate__fadeInUp animate__fast" style="width: 40px; height: 40px; background: #ffc107; border-radius: 50%; top: 30%; right: 10%;"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4 animate__animated animate__fadeInRight animate__faster">Tải Ứng Dụng BikeGo</h2>
                <p class="lead mb-4 animate__animated animate__fadeInRight animate__fast">Trải nghiệm đầy đủ tính năng hệ thống xe đạp thông minh trên smartphone của bạn.</p>
                <ul class="list-unstyled mb-4">
                    <li class="mb-3 animate__animated animate__fadeInRight animate__fast">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>Định vị trạm xe gần nhất
                    </li>
                    <li class="mb-3 animate__animated animate__fadeInRight animate__fast" style="animation-delay: 0.1s;">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>Quét mã QR mở khóa nhanh chóng
                    </li>
                    <li class="mb-3 animate__animated animate__fadeInRight animate__fast" style="animation-delay: 0.2s;">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>Theo dõi lịch sử chuyến đi
                    </li>
                    <li class="mb-3 animate__animated animate__fadeInRight animate__fast" style="animation-delay: 0.3s;">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>Thanh toán trực tuyến an toàn
                    </li>
                </ul>
                <div class="d-flex gap-3 animate__animated animate__fadeInUp animate__fast">
                    <a href="#" class="btn btn-dark btn-lg px-4 rounded-pill hover-lift">
                        <i class="bi bi-apple me-2"></i>App Store
                    </a>
                    <a href="#" class="btn btn-dark btn-lg px-4 rounded-pill hover-lift">
                        <i class="bi bi-google-play me-2"></i>Google Play
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Câu Hỏi Thường Gặp</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Làm thế nào để đăng ký tài khoản BikeGo?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Bạn có thể đăng ký tài khoản BikeGo thông qua ứng dụng di động hoặc website. Chỉ cần cung cấp số điện thoại, email và thông tin cơ bản. Quá trình xác thực diễn ra tự động và chỉ mất vài phút.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Chi phí thuê xe như thế nào?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                BikeGo có nhiều gói giá linh hoạt: Gói theo giờ từ 10.000đ/30 phút, gói theo ngày 50.000đ/ngày. Sinh viên và người dùng thường xuyên được giảm giá đặc biệt.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Làm sao biết trạm nào còn xe?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Ứng dụng BikeGo hiển thị bản đồ thời gian thực với số lượng xe khả dụng tại mỗi trạm. Bạn cũng có thể đặt xe trước qua app để đảm bảo có xe khi đến trạm.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Nếu xe gặp sự cố thì làm sao?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Trong trường hợp xe gặp sự cố, hãy liên hệ hotline 24/7: 1900-xxxx hoặc sử dụng nút "Báo sự cố" trên app. Đội ngũ kỹ thuật sẽ hỗ trợ bạn trong vòng 15 phút.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- News/Blog Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Tin Tức & Sự Kiện</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?q=80&w=400" class="card-img-top" alt="News 1">
                    <div class="card-body">
                        <span class="badge bg-success mb-2">Công nghệ</span>
                        <h5 class="card-title">BikeGo ra mắt trạm xe thông minh thế hệ mới</h5>
                        <p class="card-text text-muted">Tích hợp công nghệ IoT và AI để tối ưu hóa vận hành...</p>
                        <a href="#" class="btn btn-link text-success p-0">Đọc thêm →</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1512187849-463fdb898f21?q=80&w=400" class="card-img-top" alt="News 2">
                    <div class="card-body">
                        <span class="badge bg-success mb-2">Sự kiện</span>
                        <h5 class="card-title">Chiến dịch "Xanh hơn mỗi ngày"</h5>
                        <p class="card-text text-muted">Khuyến khích người dân sử dụng phương tiện xanh...</p>
                        <a href="#" class="btn btn-link text-success p-0">Đọc thêm →</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1533900298318-6b8da08a523e?q=80&w=400" class="card-img-top" alt="News 3">
                    <div class="card-body">
                        <span class="badge bg-success mb-2">Cộng đồng</span>
                        <h5 class="card-title">Mở rộng mạng lưới trạm xe đến 100 điểm</h5>
                        <p class="card-text text-muted">Phủ sóng toàn thành phố, phục vụ tốt hơn cho người dân...</p>
                        <a href="#" class="btn btn-link text-success p-0">Đọc thêm →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Khách Hàng Nói Gì Về BikeGo</h2>
        <div class="row g-4">
            <!-- Testimonial 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="card-text mb-4">"Hệ thống xe đạp thông minh của BikeGo thực sự tiện lợi. Tôi sử dụng hàng ngày để đi làm và rất hài lòng với dịch vụ. App dễ sử dụng, xe luôn sạch sẽ và sẵn sàng."</p>
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name=Nguyen+Van+A&background=28a745&color=fff&size=64" alt="Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                            <div>
                                <h6 class="mb-0 fw-bold">Nguyễn Văn A</h6>
                                <small class="text-muted">Doanh nhân</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="card-text mb-4">"Là một sinh viên, tôi thấy BikeGo là giải pháp hoàn hảo cho việc di chuyển trong thành phố. Giá cả phải chăng, quy trình thuê xe đơn giản. Rất khuyến khích mọi người sử dụng!"</p>
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name=Tran+Thi+B&background=28a745&color=fff&size=64" alt="Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                            <div>
                                <h6 class="mb-0 fw-bold">Trần Thị B</h6>
                                <small class="text-muted">Sinh viên</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Testimonial 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-half text-warning"></i>
                        </div>
                        <p class="card-text mb-4">"Tôi ấn tượng với công nghệ IoT mà BikeGo sử dụng. Việc theo dõi xe, khóa tự động và thanh toán không tiền mặt giúp tiết kiệm rất nhiều thời gian. Đội ngũ hỗ trợ cũng rất nhiệt tình."</p>
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name=Le+Van+C&background=28a745&color=fff&size=64" alt="Avatar" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                            <div>
                                <h6 class="mb-0 fw-bold">Lê Văn C</h6>
                                <small class="text-muted">Kỹ sư IT</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Review Statistics -->
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-3 text-center">
                                <h3 class="display-4 fw-bold text-success mb-0">4.8</h3>
                                <div class="mb-2">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-half text-warning"></i>
                                </div>
                                <p class="text-muted mb-0">Đánh giá trung bình</p>
                            </div>
                            <div class="col-md-9">
                                <div class="progress mb-2" style="height: 10px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>5 sao</span>
                                    <span class="text-muted">85%</span>
                                </div>
                                <div class="progress mb-2" style="height: 10px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>4 sao</span>
                                    <span class="text-muted">10%</span>
                                </div>
                                <div class="progress mb-2" style="height: 10px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 5%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>3 sao</span>
                                    <span class="text-muted">5%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-success text-white">
    <div class="container text-center">
        <h2 class="mb-4">Sẵn Sàng Trải Nghiệm?</h2>
        <p class="lead mb-4">Tham gia cộng đồng BikeGo ngay hôm nay và nhận ưu đãi đặc biệt cho chuyến đi đầu tiên!</p>
        <a href="register.php" class="btn btn-light btn-lg px-5 rounded-pill">Bắt Đầu Ngay</a>
    </div>
</section>

<!-- CSS Styles -->
<style>
    .carousel-item {
        height: 600px;
    }
    
    .carousel-slide {
        height: 100%;
        display: flex;
        align-items: center;
    }
    
    .carousel-indicators [data-bs-target] {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin: 0 5px;
    }
    
    .carousel-control-prev,
    .carousel-control-next {
        width: 5%;
        opacity: 0.8;
    }
    
    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 1;
    }
    
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 40px;
        height: 40px;
    }
    
    .custom-shape-divider-bottom-1681764621 {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        overflow: hidden;
        line-height: 0;
    }
    
    .custom-shape-divider-bottom-1681764621 svg {
        position: relative;
        display: block;
        width: calc(100% + 1.3px);
        height: 100px;
    }
    
    .feature-icon {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .card {
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-10px);
    }
    
    .partner-logo-wrapper {
        transition: transform 0.3s ease;
        height: 100%;
    }
    
    .partner-logo-wrapper:hover {
        transform: translateY(-5px);
    }
    
    .phone-mockup {
        position: relative;
    }
    
    .phone-frame {
        position: relative;
        padding: 10px;
        border: 5px solid #333;
        border-radius: 35px;
    }
    
    .phone-screen {
        position: relative;
        overflow: hidden;
        border-radius: 25px;
    }
    
    .floating-element {
        opacity: 0.8;
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(10deg); }
        100% { transform: translateY(0px) rotate(0deg); }
    }
    
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    
    .app-showcase .position-absolute {
        animation-iteration-count: infinite;
        animation-duration: 3s;
    }
    
    .bg-opacity-95 {
        background-color: rgba(255, 255, 255, 0.95);
    }
    
    @media (max-width: 768px) {
        .hero {
            min-height: 400px;
        }
        
        .display-3 {
            font-size: 2.5rem;
        }
        
        .phone-mockup {
            max-width: 250px !important;
        }
    }
</style>

<?php require_once 'includes/footer.php'; ?>