String.prototype.getBytes = function() {   
      var cArr = this.match(/[^\x00-\xff]/ig);   
      return this.length + (cArr == null ? 0 : cArr.length*2);   
  }  