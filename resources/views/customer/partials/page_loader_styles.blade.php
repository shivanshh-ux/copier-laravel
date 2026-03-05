<style>
    #page-loader {
        position: fixed;
        inset: 0;
        z-index: 10000;
        background: #060D1A;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 0.5s ease, visibility 0.5s ease;
    }
    #page-loader.hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }
    .spinner-container {
        position: relative;
        width: 80px;
        height: 80px;
    }
    .spinner-circle {
        position: absolute;
        inset: 0;
        border: 2px solid rgba(0, 212, 255, 0.1);
        border-top-color: #00D4FF;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        box-shadow: 0 0 15px rgba(0, 212, 255, 0.2);
    }
    .spinner-inner {
        position: absolute;
        inset: 15px;
        border: 2px solid rgba(30, 95, 173, 0.1);
        border-bottom-color: #1E5FAD;
        border-radius: 50%;
        animation: spin-reverse 1.5s linear infinite;
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    @keyframes spin-reverse {
        to { transform: rotate(-360deg); }
    }
    .loader-text {
        position: absolute;
        bottom: -40px;
        left: 50%;
        transform: translateX(-50%);
        font-family: 'Rajdhani', sans-serif;
        font-weight: 600;
        font-size: 14px;
        color: #00D4FF;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        white-space: nowrap;
        animation: pulse 2s ease-in-out infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 0.5; }
        50% { opacity: 1; }
    }
</style>
