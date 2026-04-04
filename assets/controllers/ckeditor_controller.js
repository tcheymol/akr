import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  static targets = ['container']
  editor = null;
  _beforeCacheHandler = null;

  connect() {
    if (this.editor) return;
    window.ClassicEditor.create(this.containerTarget, {
        toolbar: ['heading', '|',
          'bold', 'italic', 'link', '|',
          'alignment', '|',
          'numberedList', 'bulletedList'
        ]
      }
    ).then(editor => {
      this.editor = editor;
      this._beforeCacheHandler = () => this._destroyEditor();
      document.addEventListener('turbo:before-cache', this._beforeCacheHandler);
    });
  }

  disconnect() {
    if (this._beforeCacheHandler) {
      document.removeEventListener('turbo:before-cache', this._beforeCacheHandler);
      this._beforeCacheHandler = null;
    }
    this._destroyEditor();
  }

  _destroyEditor() {
    if (this.editor) {
      this.editor.destroy();
      this.editor = null;
    }
  }
}
