import { Controller } from '@hotwired/stimulus';
import axios from 'axios';

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
  static targets = ['container']

  static values = {
    updateUrl: String,
  }

  showForm() {
    axios.get(this.updateUrlValue).then((response) => {
      this.containerTarget.innerHTML = response.data;
    });
  }

  submitForm(event) {
    event.preventDefault();
    const form = event.target;
    axios.post(this.updateUrlValue, new FormData(form)).then((response) => {
      this.containerTarget.innerHTML = response.data;
    });
  }
}
