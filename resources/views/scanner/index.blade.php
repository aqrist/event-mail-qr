@extends('layouts.app')

@section('title', 'QR Scanner - Admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            
            <!-- Header -->
            <div class="text-center mb-4">
                <h1 class="display-6 text-primary">📱 QR Scanner</h1>
                <p class="lead">Scan QR code peserta untuk check-in</p>
            </div>

            <!-- Mobile View - QR Camera Scanner -->
            <div class="d-block d-lg-none" id="mobile-scanner">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">📷 Scan QR Code</h4>
                    </div>
                    <div class="card-body p-2">
                        
                        <!-- Camera Container -->
                        <div id="qr-reader" style="width: 100%; max-width: 500px; margin: 0 auto;"></div>
                        
                        <!-- Scanner Controls -->
                        <div class="text-center mt-3">
                            <button id="start-scan" class="btn btn-success btn-lg me-2">
                                <i class="fas fa-play"></i> Mulai Scan
                            </button>
                            <button id="stop-scan" class="btn btn-danger btn-lg" style="display: none;">
                                <i class="fas fa-stop"></i> Stop
                            </button>
                        </div>

                        <!-- Camera Selection -->
                        <div class="mt-3">
                            <select id="camera-select" class="form-select">
                                <option value="">Pilih Kamera...</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div id="scan-status" class="alert alert-info mt-3" style="display: none;">
                            <strong>Status:</strong> <span id="status-text">Menunggu...</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop View - Manual Input -->
            <div class="d-none d-lg-block" id="desktop-scanner">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow">
                            <div class="card-header bg-info text-white text-center">
                                <h4 class="mb-0">⌨️ Input Manual QR Code</h4>
                            </div>
                            <div class="card-body">
                                
                                <!-- Manual Input Form -->
                                <form id="manual-qr-form">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input type="text" id="qr-input" class="form-control form-control-lg" 
                                                   placeholder="Masukkan kode QR atau scan dengan barcode scanner..." 
                                                   autocomplete="off">
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                                <i class="fas fa-search"></i> Check-in
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <!-- Help Text -->
                                <div class="mt-3">
                                    <small class="text-muted">
                                        💡 <strong>Tips:</strong> 
                                        Anda bisa menggunakan barcode scanner USB atau ketik manual kode QR dari tiket peserta.
                                    </small>
                                </div>

                                <!-- Quick Camera Toggle for Desktop -->
                                <div class="text-center mt-4">
                                    <button id="toggle-camera" class="btn btn-outline-primary">
                                        <i class="fas fa-camera"></i> Aktifkan Kamera
                                    </button>
                                </div>

                                <!-- Hidden Camera Section for Desktop -->
                                <div id="desktop-camera" style="display: none;" class="mt-4">
                                    <div class="text-center">
                                        <div id="qr-reader-desktop" style="width: 100%; max-width: 400px; margin: 0 auto;"></div>
                                        <div class="mt-3">
                                            <button id="start-scan-desktop" class="btn btn-success me-2">
                                                <i class="fas fa-play"></i> Mulai Scan
                                            </button>
                                            <button id="stop-scan-desktop" class="btn btn-danger" style="display: none;">
                                                <i class="fas fa-stop"></i> Stop
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Results Section -->
            <div class="row justify-content-center mt-4">
                <div class="col-lg-8">
                    <div id="scan-result" style="display: none;">
                        <!-- Results will be populated here -->
                    </div>
                </div>
            </div>

            <!-- Recent Scans -->
            <div class="row justify-content-center mt-4">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">📋 Scan Terakhir</h5>
                        </div>
                        <div class="card-body">
                            <div id="recent-scans">
                                <p class="text-muted text-center">Belum ada scan hari ini.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include HTML5 QR Code Library -->
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let html5QrCode = null;
    let html5QrCodeDesktop = null;
    let cameras = [];
    let recentScans = JSON.parse(localStorage.getItem('recentScans') || '[]');

    // Display recent scans
    displayRecentScans();

    // Mobile Scanner Functions
    function startMobileScanner() {
        const config = {
            fps: 10,
            qrbox: { width: 250, height: 250 },
            aspectRatio: 1.0
        };

        html5QrCode = new Html5Qrcode("qr-reader");
        
        Html5Qrcode.getCameras().then(devices => {
            cameras = devices;
            populateCameraSelect();
            
            if (devices && devices.length) {
                const cameraId = devices[devices.length - 1].id; // Use back camera
                
                html5QrCode.start(
                    cameraId,
                    config,
                    qrCodeSuccessCallback,
                    qrCodeErrorCallback
                ).then(() => {
                    document.getElementById('start-scan').style.display = 'none';
                    document.getElementById('stop-scan').style.display = 'inline-block';
                    updateStatus('Kamera aktif, arahkan ke QR code...', 'info');
                }).catch(err => {
                    console.error('Error starting scanner:', err);
                    updateStatus('Error: ' + err, 'danger');
                });
            }
        }).catch(err => {
            console.error('Error getting cameras:', err);
            updateStatus('Error accessing camera: ' + err, 'danger');
        });
    }

    function stopMobileScanner() {
        if (html5QrCode) {
            html5QrCode.stop().then(() => {
                document.getElementById('start-scan').style.display = 'inline-block';
                document.getElementById('stop-scan').style.display = 'none';
                updateStatus('Scanner dihentikan', 'secondary');
            }).catch(err => {
                console.error('Error stopping scanner:', err);
            });
        }
    }

    // Desktop Camera Functions
    function startDesktopCamera() {
        const config = {
            fps: 10,
            qrbox: { width: 200, height: 200 }
        };

        html5QrCodeDesktop = new Html5Qrcode("qr-reader-desktop");
        
        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                const cameraId = devices[0].id;
                
                html5QrCodeDesktop.start(
                    cameraId,
                    config,
                    qrCodeSuccessCallback,
                    qrCodeErrorCallback
                ).then(() => {
                    document.getElementById('start-scan-desktop').style.display = 'none';
                    document.getElementById('stop-scan-desktop').style.display = 'inline-block';
                });
            }
        });
    }

    function stopDesktopCamera() {
        if (html5QrCodeDesktop) {
            html5QrCodeDesktop.stop().then(() => {
                document.getElementById('start-scan-desktop').style.display = 'inline-block';
                document.getElementById('stop-scan-desktop').style.display = 'none';
            });
        }
    }

    // QR Code Callbacks
    function qrCodeSuccessCallback(decodedText, decodedResult) {
        console.log('QR Code detected:', decodedText);
        processQRCode(decodedText);
    }

    function qrCodeErrorCallback(error) {
        // Handle scan failure, usually ignore these
    }

    // Process QR Code
    function processQRCode(qrCode) {
        updateStatus('QR Code terdeteksi: ' + qrCode, 'success');
        
        // Check if it's a valid ticket URL
        if (qrCode.includes('/attendance/scan/') || qrCode.includes('/ticket/')) {
            // Extract QR code from URL
            const qrCodeOnly = qrCode.split('/').pop();
            checkInParticipant(qrCodeOnly);
        } else {
            // Assume it's just the QR code
            checkInParticipant(qrCode);
        }
    }

    // Check-in Participant
    function checkInParticipant(qrCode) {
        fetch(`/attendance/scan/${qrCode}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('scan-result').innerHTML = html;
                document.getElementById('scan-result').style.display = 'block';
                
                // Add to recent scans
                addToRecentScans(qrCode);
                
                // Auto-scroll to result
                document.getElementById('scan-result').scrollIntoView({ 
                    behavior: 'smooth' 
                });
            })
            .catch(error => {
                console.error('Error:', error);
                showError('Error melakukan check-in: ' + error.message);
            });
    }

    // Helper Functions
    function updateStatus(message, type) {
        const statusElement = document.getElementById('scan-status');
        const statusText = document.getElementById('status-text');
        
        statusText.textContent = message;
        statusElement.className = `alert alert-${type} mt-3`;
        statusElement.style.display = 'block';
    }

    function populateCameraSelect() {
        const select = document.getElementById('camera-select');
        select.innerHTML = '<option value="">Pilih Kamera...</option>';
        
        cameras.forEach((camera, index) => {
            const option = document.createElement('option');
            option.value = camera.id;
            option.textContent = camera.label || `Kamera ${index + 1}`;
            select.appendChild(option);
        });
    }

    function addToRecentScans(qrCode) {
        const scan = {
            qrCode: qrCode,
            timestamp: new Date().toLocaleString('id-ID'),
            time: Date.now()
        };
        
        recentScans.unshift(scan);
        recentScans = recentScans.slice(0, 10); // Keep only last 10
        
        localStorage.setItem('recentScans', JSON.stringify(recentScans));
        displayRecentScans();
    }

    function displayRecentScans() {
        const container = document.getElementById('recent-scans');
        
        if (recentScans.length === 0) {
            container.innerHTML = '<p class="text-muted text-center">Belum ada scan hari ini.</p>';
            return;
        }
        
        let html = '<div class="table-responsive"><table class="table table-sm">';
        html += '<thead><tr><th>QR Code</th><th>Waktu</th></tr></thead><tbody>';
        
        recentScans.forEach(scan => {
            html += `<tr>
                <td><code>${scan.qrCode}</code></td>
                <td>${scan.timestamp}</td>
            </tr>`;
        });
        
        html += '</tbody></table></div>';
        container.innerHTML = html;
    }

    function showError(message) {
        const errorHtml = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        document.getElementById('scan-result').innerHTML = errorHtml;
        document.getElementById('scan-result').style.display = 'block';
    }

    // Event Listeners
    document.getElementById('start-scan').addEventListener('click', startMobileScanner);
    document.getElementById('stop-scan').addEventListener('click', stopMobileScanner);
    
    document.getElementById('start-scan-desktop').addEventListener('click', startDesktopCamera);
    document.getElementById('stop-scan-desktop').addEventListener('click', stopDesktopCamera);

    // Camera selection change
    document.getElementById('camera-select').addEventListener('change', function() {
        if (html5QrCode && this.value) {
            stopMobileScanner();
            setTimeout(() => {
                const config = {
                    fps: 10,
                    qrbox: { width: 250, height: 250 }
                };
                
                html5QrCode.start(
                    this.value,
                    config,
                    qrCodeSuccessCallback,
                    qrCodeErrorCallback
                );
            }, 500);
        }
    });

    // Manual QR Form
    document.getElementById('manual-qr-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const qrCode = document.getElementById('qr-input').value.trim();
        
        if (qrCode) {
            processQRCode(qrCode);
            document.getElementById('qr-input').value = '';
        }
    });

    // Toggle Camera for Desktop
    document.getElementById('toggle-camera').addEventListener('click', function() {
        const cameraSection = document.getElementById('desktop-camera');
        const isVisible = cameraSection.style.display !== 'none';
        
        if (isVisible) {
            cameraSection.style.display = 'none';
            this.innerHTML = '<i class="fas fa-camera"></i> Aktifkan Kamera';
            stopDesktopCamera();
        } else {
            cameraSection.style.display = 'block';
            this.innerHTML = '<i class="fas fa-camera-slash"></i> Sembunyikan Kamera';
        }
    });

    // Auto-focus on QR input for desktop
    if (window.innerWidth >= 992) {
        document.getElementById('qr-input').focus();
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // F1 - Toggle scanner on mobile
        if (e.key === 'F1') {
            e.preventDefault();
            if (window.innerWidth < 992) {
                const startBtn = document.getElementById('start-scan');
                const stopBtn = document.getElementById('stop-scan');
                
                if (startBtn.style.display !== 'none') {
                    startMobileScanner();
                } else {
                    stopMobileScanner();
                }
            }
        }
        
        // Escape - Stop all scanners
        if (e.key === 'Escape') {
            stopMobileScanner();
            stopDesktopCamera();
        }
    });
});
</script>

<style>
    /* Custom styles for QR scanner */
    #qr-reader, #qr-reader-desktop {
        border: 2px solid #dee2e6;
        border-radius: 8px;
        overflow: hidden;
    }
    
    #qr-reader video, #qr-reader-desktop video {
        width: 100%;
        height: auto;
        display: block;
    }
    
    .table-responsive {
        max-height: 300px;
        overflow-y: auto;
    }
    
    @media (max-width: 991px) {
        .container-fluid {
            padding: 10px;
        }
        
        #qr-reader {
            max-height: 300px;
        }
    }
    
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    .alert {
        border-radius: 8px;
    }
    
    /* Loading animation */
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.5; }
        100% { opacity: 1; }
    }
    
    .scanning {
        animation: pulse 1s infinite;
    }
</style>
@endsection