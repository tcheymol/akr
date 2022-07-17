import { Controller } from '@hotwired/stimulus';
import Swal from 'sweetalert2';

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
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
