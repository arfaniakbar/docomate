<x-karyawan-layout>

    <head>
        {{-- Memuat file CSS dan JS Dropzone --}}
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    </head>

    <style>
        /* Gaya umum (Tailwind like utilities) */
        .card {
            background-color: #fff;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 16px;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .btn-submit {
            display: block;
            width: 100%;
            padding: 0.875rem;
            border: none;
            border-radius: 8px;
            background-color: #dc2626;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-submit:disabled {
            background-color: #fca5a5;
            cursor: not-allowed;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #f87171;
            white-space: pre-line;
        }

        .alert-success {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }

        /* Dropzone Styling */
        .dropzone {
            border: 2px dashed #dc2626;
            border-radius: 12px;
            background: #fee2e2;
            padding: 15px;
            transition: all 0.3s;
            min-height: 150px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .dropzone .dz-message {
            color: #b91c1c;
        }

        .dropzone .dz-preview {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            padding: 12px;
            margin: 12px;
            width: 220px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .dropzone .dz-preview .dz-image {
            width: 100%;
            height: 140px;
            margin-bottom: 10px;
        }

        .dropzone .dz-preview .dz-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
        }

        .caption-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f9fafb;
            text-align: center;
            font-size: 0.85rem;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .remove-btn {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>

    <div class="card">
        <h2 class="card-header">Upload Evidence</h2>

        <div id="notification-area" style="display: none;"></div>

        <form action="{{ route('karyawan.evidence.store') }}" id="evidence-form" method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label for="lokasi">Masukkan Lokasi Anda</label>
                <input type="text" id="lokasi" name="lokasi" placeholder="Contoh: Telkom STO Banjarmasin" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Umum (Opsional)</label>
                <textarea id="deskripsi" name="deskripsi" rows="3"
                    placeholder="Deskripsi umum atau catatan tambahan..."></textarea>
            </div>

            {{-- START: DROPDOWN MASTER DATA (SEMUA WAJIB) --}}

            {{-- Pangwas (WAJIB) --}}
            <div class="form-group">
                <label for="pangwas_id">Pilih Waspang (Waspang)</label>
                <select id="pangwas_id" name="pangwas_id" class="form-group select" required>
                    <option value="">-- Pilih Waspang --</option>
                    @foreach ($pangwas_list as $pangwas)
                        <option value="{{ $pangwas->id }}">{{ $pangwas->nama_pangwas }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Tematik (Wajib) --}}
            <div class="form-group">
                <label for="tematik_id">Pilih Tematik</label>
                <select id="tematik_id" name="tematik_id" class="form-group select" required>
                    <option value="">-- Pilih Tematik --</option>
                    @foreach ($tematik_list as $tematik)
                        <option value="{{ $tematik->id }}">{{ $tematik->nama_tematik }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Purchase Order (PO) (Wajib) --}}
            <div class="form-group">
                <label for="po_id">Nomor Purchase Order (PO)</label>
                <select id="po_id" name="po_id" class="form-group select" required>
                    <option value="">-- Pilih Nomor PO --</option>
                    @foreach ($po_list as $po)
                        <option value="{{ $po->id }}">{{ $po->no_po }}</option>
                    @endforeach
                </select>
            </div>

            {{-- END: DROPDOWN MASTER DATA --}}


            <div class="form-group">
                <label>File Evidence</label>
                <div id="evidence-dropzone" class="dropzone">
                    <div class="dz-message" data-dz-message><span>Seret folder/foto ke sini atau klik untuk memilih
                    </span></div>
                </div>
            </div>

            <button type="button" id="submit-button" class="btn-submit" style="margin-top: 1rem;">Upload
                Evidence</button>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                if (document.querySelector("#evidence-dropzone").dropzone) {
                    Dropzone.forElement("#evidence-dropzone").destroy();
                }

                const previewTemplate = `
                    <div class="dz-preview dz-file-preview">
                        <div class="dz-image"><img data-dz-thumbnail /></div>
                        <input type="text" name="caption[]" class="caption-input" placeholder="Deskripsi foto (opsional)...">
                        <button type="button" data-dz-remove class="remove-btn">X</button>
                        <div class="dz-error-message"><span data-dz-errormessage></span></div>
                    </div>
                `;

                let evidenceId = null; // Variable global untuk menyimpan ID evidence

                Dropzone.autoDiscover = false;
                let myDropzone = new Dropzone("#evidence-dropzone", {
                    url: "{{ route('karyawan.evidence.store') }}",
                    paramName: "file",
                    autoProcessQueue: false, // 🔴 JANGAN auto upload, tunggu ID dibuat dulu
                    uploadMultiple: true,
                    parallelUploads: 5, // 🔴 Upload per 5 file agar aman dari limit server (max 20)
                    maxFiles: null,
                    maxFilesize: null,
                    acceptedFiles: 'image/*',
                    addRemoveLinks: false,
                    previewTemplate: previewTemplate,
                    timeout: 180000, // 3 menit timeout per request

                    init: function () {
                        const self = this;
                        const form = document.querySelector("#evidence-form");
                        const submitButton = document.querySelector("#submit-button");
                        const notificationArea = document.querySelector("#notification-area");

                        let folderName = null;

                        // --- LOGIKA DETEKSI FOLDER DROP ---
                        const dropzoneElement = document.getElementById('evidence-dropzone');
                        dropzoneElement.addEventListener('drop', function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            folderName = null;
                            if (e.dataTransfer.items && e.dataTransfer.items.length > 0) {
                                const item = e.dataTransfer.items[0];
                                if (item.webkitGetAsEntry) {
                                    const entry = item.webkitGetAsEntry();
                                    if (entry && entry.isDirectory) {
                                        folderName = entry.name;
                                    }
                                }
                            }
                        });

                        // --- LOGIKA COPY CAPTION ---
                        this.on("addedfile", function (file) {
                            let captionInput = file.previewElement.querySelector('.caption-input');
                            if (captionInput) {
                                let fileName = file.name;
                                let baseName = fileName.replace(/\.[^/.]+$/, "");
                                let finalCaption = baseName;
                                if (file.fullPath) {
                                    finalCaption = file.fullPath;
                                } else if (file.webkitRelativePath) {
                                    finalCaption = file.webkitRelativePath;
                                } else if (folderName) {
                                    finalCaption = `${folderName}/${baseName}`;
                                }
                                captionInput.value = finalCaption;
                            }
                        });

                        // 1. TOMBOL SUBMIT DIKLIK
                        submitButton.addEventListener("click", function (e) {
                            e.preventDefault();
                            e.stopPropagation();

                            // Validasi Form
                            if (form.querySelector("#lokasi").value.trim() === "" ||
                                form.querySelector("#pangwas_id").value === "" ||
                                form.querySelector("#tematik_id").value === "" ||
                                form.querySelector("#po_id").value === "") {

                                notificationArea.innerHTML = `<div class="alert alert-danger">Lokasi, Pengawas, Tematik, dan Nomor PO wajib diisi!</div>`;
                                notificationArea.style.display = 'block';
                                window.scrollTo({ top: 0, behavior: 'smooth' });
                                return;
                            }

                            if (self.getQueuedFiles().length === 0) {
                                notificationArea.innerHTML = `<div class="alert alert-danger">Mohon pilih minimal satu file gambar!</div>`;
                                notificationArea.style.display = 'block';
                                return;
                            }

                            // MODE START: Buat Evidence Kosong Dulu
                            submitButton.disabled = true;
                            submitButton.innerText = 'Menginisialisasi Data...';

                            const initData = new FormData();
                            initData.append("_token", form.querySelector('input[name="_token"]').value);
                            initData.append("is_init", "1"); // Flag Inisialisasi
                            initData.append("lokasi", form.querySelector('#lokasi').value);
                            initData.append("deskripsi", form.querySelector('#deskripsi').value);
                            initData.append("pangwas_id", form.querySelector('#pangwas_id').value);
                            initData.append("tematik_id", form.querySelector('#tematik_id').value);
                            initData.append("po_id", form.querySelector('#po_id').value);

                            fetch("{{ route('karyawan.evidence.store') }}", {
                                method: "POST",
                                body: initData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.status === 'success') {
                                        evidenceId = data.evidence_id; // SIMPAN ID EVIDENCE

                                        submitButton.innerText = 'Mengupload Foto (Mohon Tunggu)...';

                                        // Mulai Proses Upload File (Batching otomatis oleh Dropzone)
                                        self.processQueue();
                                    } else {
                                        throw new Error(data.message || 'Gagal inisialisasi data.');
                                    }
                                })
                                .catch(err => {
                                    notificationArea.innerHTML = `<div class="alert alert-danger">Error: ${err.message}</div>`;
                                    notificationArea.style.display = 'block';
                                    submitButton.disabled = false;
                                    submitButton.innerText = 'Upload Evidence';
                                    window.scrollTo({ top: 0, behavior: 'smooth' });
                                });
                        });

                        // 2. SAAT FILE AKAN DIKIRIM (Per Batch)
                        this.on("sendingmultiple", function (files, xhr, formData) {
                            formData.append("_token", form.querySelector('input[name="_token"]').value);
                            // Kunci: Kirim ID evidence yang barusan dibuat
                            formData.append("evidence_id", evidenceId);

                            // Caption
                            files.forEach(function (file) {
                                let captionInput = file.previewElement.querySelector('.caption-input');
                                formData.append("caption[]", captionInput ? captionInput.value : '');
                            });
                        });

                        // 3. SUKSES SATU BATCH
                        this.on("successmultiple", function (files, response) {
                            // Jika masih ada file di antrian, Dropzone biasanya stop kalau autoProcessQueue false.
                            // Kita paksa jalan lagi.
                            if (self.getQueuedFiles().length > 0) {
                                self.processQueue();
                            }
                        });

                        // 4. SEMUA SELESAI
                        this.on("queuecomplete", function () {
                            // Cek apakah benar-benar kosong antriannya & uploding selesai
                            if (self.getQueuedFiles().length === 0 && self.getUploadingFiles().length === 0) {
                                notificationArea.innerHTML = `<div class="alert alert-success">Semua foto berhasil di-upload! Mengalihkan...</div>`;
                                notificationArea.style.display = 'block';

                                setTimeout(() => {
                                    const count = self.getAcceptedFiles().length;
                                    window.location.href = "{{ route('karyawan.evidence.index') }}?upload_success=" + count;
                                }, 1000);
                            }
                        });

                        // 5. ERROR HANDLING
                        this.on("errormultiple", function (files, response) {
                            let errorMessage = response.message || "Gagal mengupload sebagian file.";
                            notificationArea.innerHTML = `<div class="alert alert-danger">${errorMessage}</div>`;
                            notificationArea.style.display = 'block';

                            // Jangan matikan tombol, biarkan user coba lagi atau refresh
                            submitButton.innerText = 'Coba Upload Sisa File';
                            submitButton.disabled = false;
                        });
                    }
                });
            });
        </script>
    @endpush
</x-karyawan-layout>