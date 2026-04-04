import { Controller } from '@hotwired/stimulus';
import Swal from 'sweetalert2';

export default class extends Controller {
  static values = {
    text: String,
    confirmUrl: String,
  }

  warn() {
    Swal.fire({
      title: this.textValue,
      icon: 'warning',
      confirmButtonText: 'Oui',
      showCancelButton: true,
      cancelButtonText: 'Non'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.replace(this.confirmUrlValue);
      }
    })
  }
}
