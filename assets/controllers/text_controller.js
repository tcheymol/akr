import { Controller } from '@hotwired/stimulus';
import axios from 'axios';

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
