
namespace php service.x

include "base.thrift"
include "x.thrift"

service xAPI
{
	/** 卡牌详情 */
	x.xResp xInfo(1: x.xReq req) throws (1: base.baseException err);
}

