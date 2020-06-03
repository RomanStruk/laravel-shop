export function required(value) {
    return value !== "";

}

export function notGmail(value = "") {
    return !value.includes("gmail");
}

export function isEmailAvailable(value) {
    if (value === "") return true;

    return new Promise((resolve, reject) => {
        setTimeout(() => {
            resolve(value.length > 10);
        }, 500);
    });
}