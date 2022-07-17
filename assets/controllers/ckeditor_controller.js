import { Controller } from '@hotwired/stimulus';
import CkEditor from '@ckeditor/ckeditor5-build-classic'

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://github.com/symfony/stimulus-bridge#lazy-controllers
*/
/* stimulusFetch: 'lazy' */
export default class extends Controller {
  static targets = ['container']

  connect() {
    CkEditor.create(this.containerTarget, {
        toolbar: ['heading', '|',
          'bold', 'italic', 'underline', 'link', '|',
          'alignment', '|',
          'numberedList', 'bulletedList'
        ]
      }
    );
  }
}
