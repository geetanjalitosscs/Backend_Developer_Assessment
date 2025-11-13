#!/bin/bash
# ===============================
# File: start-server.sh
# PHP Built-in Server Startup Script for Ubuntu VPS
# ===============================

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Get the directory where the script is located
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd "$SCRIPT_DIR"

# Load configuration
if [ -f "config.php" ]; then
    PORT=$(grep -oP "SERVER_PORT', '\K[^']+" config.php | head -1)
    HOST=$(grep -oP "SERVER_HOST', '\K[^']+" config.php | head -1)
else
    PORT="8087"
    HOST="0.0.0.0"
fi

echo -e "${GREEN}Starting PHP Quiz API Server...${NC}"
echo -e "${YELLOW}Server will run on: http://${HOST}:${PORT}${NC}"
echo -e "${YELLOW}Access from external: http://103.14.120.163:${PORT}${NC}"
echo -e "${YELLOW}Press Ctrl+C to stop the server${NC}"
echo ""

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo -e "${RED}Error: PHP is not installed. Please install PHP first.${NC}"
    echo "Run: sudo apt update && sudo apt install php php-mysqli -y"
    exit 1
fi

# Start PHP built-in server
php -S ${HOST}:${PORT} -t . router.php 2>&1 | tee -a server.log


