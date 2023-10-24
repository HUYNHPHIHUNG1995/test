<nav class="navbar navbar-expand-lg navbar-light bg-light">
    
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            
          </li>
      </ul>
      <div class="form-inline my-2 my-lg-0" >
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Chọn
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item changeStatusAll" href=""  data-model="{{ $model }}" data-value="1" data-field="publish">Publish </a>
                  <a class="dropdown-item changeStatusAll" href="" data-model="{{ $model }}" data-value="0" data-field="publish">UnPublish</a>
                </div>
              </li>
          </ul>
      </div>
    </div>
  </nav>