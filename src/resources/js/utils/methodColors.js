export default function methodColors (method) {
    if(!method) return "#7C3AED";
    const lowerMethod = method.toLowerCase();
    switch (lowerMethod) {
        case "get":
            return {
                background:"#a855f7",
                color: "#fff"
            };
        case "post":
            return {
                background: "#0ea5e9",
                color: "#fff"
            };
        case "put":
            return {
                background: "#4f46e5",
                color: "#fff"
            };
        case "patch":
            return {
                background: "#d97706",
                color: "#fff"
            };
        case "delete":
            return {
                background: "#b91c1c",
                color: "#fff"
            };
        default:
            return {
                background: "#a855f7",
                color: "#fff"
            };
    }
}
