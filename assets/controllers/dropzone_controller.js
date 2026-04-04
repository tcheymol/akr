import { Controller } from '@hotwired/stimulus';
import Dropzone from "dropzone";

export default class extends Controller {
  static targets = ['container']
  static values = {
    url: String,
  }

  connect() {
    let myDropzone = new Dropzone(".dropzone", {
      url: this.urlValue,
    });

    myDropzone.on("addedfile", file => {
      console.log(`File added: ${file.name}`);
    });
  }
}
