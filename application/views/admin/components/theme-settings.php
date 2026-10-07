<!-- Theme Settings Offcanvas Drawer (Teknolite Theme) -->
<div>
    <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="theme-settings-offcanvas" aria-labelledby="themeSettingsOffcanvasLabel">
        <div class="d-flex align-items-center bg-primary p-3 offcanvas-header" style="background-color: #04308c !important;">
            <h5 class="text-white m-0 fs-16 fw-semibold" id="themeSettingsOffcanvasLabel">Theme Settings</h5>
            <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body p-0">
            <div data-simplebar class="h-100" style="overflow-y: auto; max-height: calc(100vh - 130px);">
                <div class="p-3 settings-bar">

                    <!-- Color Scheme -->
                    <div class="mb-4">
                        <h5 class="mb-3 font-16 fw-semibold fs-14 text-uppercase text-muted" style="letter-spacing: 0.5px;">Color Scheme</h5>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="data-bs-theme" id="layout-color-light" value="light" checked>
                            <label class="form-check-label fw-medium fs-13" for="layout-color-light">Light</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="data-bs-theme" id="layout-color-dark" value="dark">
                            <label class="form-check-label fw-medium fs-13" for="layout-color-dark">Dark</label>
                        </div>
                    </div>

                    <!-- Topbar Color -->
                    <div class="mb-4">
                        <h5 class="my-3 font-16 fw-semibold fs-14 text-uppercase text-muted" style="letter-spacing: 0.5px;">Topbar Color</h5>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="data-topbar-color" id="topbar-color-light" value="light" checked>
                            <label class="form-check-label fw-medium fs-13" for="topbar-color-light">Light</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="data-topbar-color" id="topbar-color-dark" value="dark">
                            <label class="form-check-label fw-medium fs-13" for="topbar-color-dark">Dark</label>
                        </div>
                    </div>

                    <!-- Menu Color -->
                    <div class="mb-4">
                        <h5 class="my-3 font-16 fw-semibold fs-14 text-uppercase text-muted" style="letter-spacing: 0.5px;">Menu Color</h5>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="data-menu-color" id="leftbar-color-light" value="light">
                            <label class="form-check-label fw-medium fs-13" for="leftbar-color-light">Light</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="data-menu-color" id="leftbar-color-dark" value="dark" checked>
                            <label class="form-check-label fw-medium fs-13" for="leftbar-color-dark">Dark</label>
                        </div>
                    </div>

                    <!-- Sidebar Size -->
                    <div class="mb-4">
                        <h5 class="my-3 font-16 fw-semibold fs-14 text-uppercase text-muted" style="letter-spacing: 0.5px;">Sidebar Size</h5>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-size-default" value="default" checked>
                            <label class="form-check-label fw-medium fs-13" for="leftbar-size-default">Default</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-size-small" value="condensed">
                            <label class="form-check-label fw-medium fs-13" for="leftbar-size-small">Condensed</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-hidden" value="hidden">
                            <label class="form-check-label fw-medium fs-13" for="leftbar-hidden">Hidden</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-size-small-hover-active" value="sm-hover-active">
                            <label class="form-check-label fw-medium fs-13" for="leftbar-size-small-hover-active">Small Hover Active</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-size-small-hover" value="sm-hover">
                            <label class="form-check-label fw-medium fs-13" for="leftbar-size-small-hover">Small Hover</label>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="offcanvas-footer border-top p-3 text-center">
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-danger w-100 fw-semibold" id="reset-layout">Reset</button>
                </div>
            </div>
        </div>
    </div>
</div>
