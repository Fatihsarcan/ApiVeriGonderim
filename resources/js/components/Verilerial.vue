<template>
  <div class="container">
    <div class="card">
      <h2 class="card-title">Kullanıcı Bilgileri</h2>
      <form @submit.prevent="uploadPdf" class="form">
        <input
          type="text"
          v-model="sertifikaNo"
          placeholder="Sertifika Numarası"
          class="input-field"
          required
        />
        <input
          type="text"
          v-model="isim"
          placeholder="İsim"
          class="input-field"
          required
        />
        <input
          type="text"
          v-model="soyisim"
          placeholder="Soy İsim"
          class="input-field"
          required
        />
        <div class="file-input-group">
          <label for="pdf-input" class="file-label">PDF ekle:</label>
          <input
            id="pdf-input"
            type="file"
            @change="handleFileChange"
            accept="application/pdf"
            class="file-input"
            required
          />
        </div>
        <button :disabled="loading" class="submit-btn" type="submit">
          <span v-if="!loading">Yükle</span>
          <span v-else>Yükleniyor...</span>
        </button>
      </form>
      <div v-if="error" class="alert error-alert">
        {{ error }}
      </div>
      <div v-if="success" class="alert success-alert">
        {{ success }}
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      pdfFile: null,
      sertifikaNo: '',
      isim: '',
      soyisim: '',
      loading: false,
      error: null,
      success: null,
    };
  },
  methods: {
    handleFileChange(event) {
      this.pdfFile = event.target.files[0];
    },
    async uploadPdf() {
      this.error = null;
      this.success = null;

      if (!this.pdfFile) {
        this.error = 'Lütfen bir PDF dosyası seçin.';
        return;
      }

      if (!this.sertifikaNo || !this.isim || !this.soyisim) {ğ
        this.error = 'Lütfen tüm alanları doldurun.';
        return;
      }

      const formData = new FormData();
      formData.append('pdf', this.pdfFile);
      formData.append('sertifikaNo', this.sertifikaNo);
      formData.append('isim', this.isim);
      formData.append('soyisim', this.soyisim);

      try {
        this.loading = true;
        const response = await axios.post('/api/send', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });
        this.success = 'PDF başarıyla yüklendi!';
        
       
      } catch (error) {
        this.error = 'PDF yüklenirken bir hata oluştu. Lütfen tekrar deneyin.';
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>

<style scoped>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  padding: 20px;
}

.card {
  background-color: #ffffff;
  border-radius: 8px;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 600px;
}

.card-title {
  text-align: center;
  font-size: 24px;
  margin-bottom: 20px;
}

.form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.input-field {
  margin-bottom: 10px;
  padding: 10px;
  border: 1px solid #ced4da;
  border-radius: 4px;
  width: 100%;
  max-width: 500px;
}

.file-input-group {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.file-input {
  margin-left: 10px;
}

.file-label {
  background-color: #f8f9fa;
  border: 1px solid #ced4da;
  border-radius: 4px;
  padding: 10px;
  cursor: pointer;
}

.submit-btn {
  background-color: #007bff;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  cursor: pointer;
}

.submit-btn:disabled {
  background-color: #6c757d;
}

.alert {
  margin-top: 20px;
  padding: 10px;
  border-radius: 4px;
}

.error-alert {
  background-color: #f8d7da;
  color: #721c24;
}

.success-alert {
  background-color: #d4edda;
  color: #155724;
}
</style>
